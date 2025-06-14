import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import joblib
import re
import os
from flask import Flask, request, jsonify

# Khởi tạo ứng dụng Flask
app = Flask(__name__)

# Định nghĩa các đường dẫn để dễ quản lý
DATA_PATH = 'data/posts_data.csv'
MODEL_DIR = 'models'
VECTORIZER_PATH = os.path.join(MODEL_DIR, 'tfidf_vectorizer.joblib')
MATRIX_PATH = os.path.join(MODEL_DIR, 'tfidf_matrix.joblib')
POST_IDS_PATH = os.path.join(MODEL_DIR, 'post_ids.joblib')

# Tự động tạo thư mục 'models' nếu nó chưa tồn tại
if not os.path.exists(MODEL_DIR):
    os.makedirs(MODEL_DIR)

def preprocess(text):
    """Hàm tiền xử lý văn bản: chuyển chữ thường, loại bỏ ký tự đặc biệt."""
    if not isinstance(text, str):
        return ""
    text = text.lower()
    text = re.sub(r'\W', ' ', text)
    text = re.sub(r'\s+', ' ', text)
    return text.strip()

@app.route('/train', methods=['POST'])
def train_model():
    """
    Endpoint để huấn luyện mô hình.
    Đọc dữ liệu từ CSV, vector hóa và lưu lại mô hình.
    """
    try:
        app.logger.info("Bắt đầu quá trình huấn luyện mô hình...")
        
        df = pd.read_csv(DATA_PATH)
        df.dropna(subset=['text'], inplace=True)
        
        df['cleaned_text'] = df['text'].apply(preprocess)

        # Sử dụng TF-IDF để chuyển văn bản thành vector
        vectorizer = TfidfVectorizer(max_features=1500) # Giới hạn 1500 từ phổ biến nhất
        tfidf_matrix = vectorizer.fit_transform(df['cleaned_text'])

        # Lưu các đối tượng đã được huấn luyện để tái sử dụng
        joblib.dump(vectorizer, VECTORIZER_PATH)
        joblib.dump(tfidf_matrix, MATRIX_PATH)
        joblib.dump(df['post_id'].tolist(), POST_IDS_PATH)
        
        app.logger.info("Huấn luyện và lưu mô hình thành công.")
        return jsonify({"message": f"Mô hình đã được huấn luyện thành công với {len(df)} bài viết."}), 200
        
    except Exception as e:
        app.logger.error(f"Lỗi trong quá trình huấn luyện: {e}")
        return jsonify({"error": str(e)}), 500

@app.route('/recommend', methods=['POST'])
def recommend():
    """
    Endpoint để gợi ý bài viết.
    Nhận ID và nội dung bài viết, trả về danh sách ID các bài viết liên quan.
    """
    try:
        # Kiểm tra xem các tệp mô hình đã tồn tại chưa
        if not all(os.path.exists(p) for p in [VECTORIZER_PATH, MATRIX_PATH, POST_IDS_PATH]):
             return jsonify({"error": "Mô hình chưa được huấn luyện. Vui lòng gọi /train trước."}), 400

        data = request.get_json()
        content = data.get('content')
        current_post_id = data.get('post_id')

        if not content:
            return jsonify({"error": "Yêu cầu phải có 'content'."}), 400

        # Tải các đối tượng đã được huấn luyện
        vectorizer = joblib.load(VECTORIZER_PATH)
        tfidf_matrix = joblib.load(MATRIX_PATH)
        post_ids = joblib.load(POST_IDS_PATH)

        # Xử lý và vector hóa nội dung đầu vào
        processed_content = preprocess(content)
        content_vector = vectorizer.transform([processed_content])

        # Tính độ tương đồng cosine
        cosine_similarities = cosine_similarity(content_vector, tfidf_matrix).flatten()
        
        # Lấy chỉ số của 5 bài viết tương đồng nhất
        # Sắp xếp và lấy 6 vị trí đầu để phòng trường hợp bài viết tự so sánh với chính nó
        similar_indices = cosine_similarities.argsort()[-6:][::-1]

        # Lấy ID của các bài viết gợi ý (loại bỏ chính nó nếu có)
        recommended_ids = [
            post_ids[i] for i in similar_indices 
            if post_ids[i] != current_post_id
        ]

        # Trả về top 5
        return jsonify({"recommended": recommended_ids[:5]})

    except Exception as e:
        app.logger.error(f"Lỗi trong quá trình gợi ý: {e}")
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    # Chạy ứng dụng trên cổng 5001 để không xung đột với Laravel (cổng 8000)
    app.run(host='0.0.0.0', port=5001, debug=True)
    
# === PHẦN MÃ MỚI CHO MÔ HÌNH PHÂN LOẠI - THÊM VÀO CUỐI TỆP ===

from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import classification_report
from sklearn.preprocessing import LabelEncoder

# --- Định nghĩa các đường dẫn mới ---
CLASSIFICATION_DATA_PATH = 'data/threads_for_classification.csv'
CLASSIFIER_VECTORIZER_PATH = os.path.join(MODEL_DIR, 'classifier_vectorizer.joblib')
CLASSIFIER_MODEL_PATH = os.path.join(MODEL_DIR, 'classifier_model.joblib')
LABEL_ENCODER_PATH = os.path.join(MODEL_DIR, 'label_encoder.joblib')


@app.route('/train_classifier', methods=['POST'])
def train_classifier_model():
    """
    Endpoint để huấn luyện và đánh giá mô hình phân loại.
    """
    try:
        app.logger.info("Bắt đầu quá trình huấn luyện mô hình phân loại...")
        
        # Đọc dữ liệu
        df = pd.read_csv(CLASSIFICATION_DATA_PATH)
        df.dropna(inplace=True)

        # Tiền xử lý tiêu đề
        df['cleaned_text'] = df['text'].apply(preprocess)
        
        # Mã hóa nhãn (tên chuyên mục) thành số
        le = LabelEncoder()
        df['category_code'] = le.fit_transform(df['category_name'])
        joblib.dump(le, LABEL_ENCODER_PATH) # Lưu lại để dùng khi dự đoán

        # Trích xuất đặc trưng bằng TF-IDF
        vectorizer = TfidfVectorizer(max_features=2000)
        X = vectorizer.fit_transform(df['cleaned_text'])
        y = df['category_code']
        joblib.dump(vectorizer, CLASSIFIER_VECTORIZER_PATH) # Lưu lại

        # Chia dữ liệu thành tập train và test (80/20)
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

        # Huấn luyện mô hình Logistic Regression
        classifier = LogisticRegression(random_state=42)
        classifier.fit(X_train, y_train)
        joblib.dump(classifier, CLASSIFIER_MODEL_PATH) # Lưu lại

        # Đánh giá mô hình trên tập test
        y_pred = classifier.predict(X_test)
        report = classification_report(y_test, y_pred, target_names=le.classes_, output_dict=True)
        
        app.logger.info("Hoàn thành huấn luyện và đánh giá mô hình phân loại.")
        # In kết quả đánh giá ra console của Flask để bạn xem
        print("\n--- BÁO CÁO ĐÁNH GIÁ MÔ HÌNH PHÂN LOẠI ---")
        print(classification_report(y_test, y_pred, target_names=le.classes_))
        print("-------------------------------------------\n")
        
        return jsonify({
            "message": "Mô hình phân loại đã được huấn luyện thành công.",
            "evaluation_report": report
        }), 200

    except Exception as e:
        app.logger.error(f"Lỗi trong quá trình huấn luyện phân loại: {e}")
        return jsonify({"error": str(e)}), 500

@app.route('/classify', methods=['POST'])
def classify_thread():
    """
    Endpoint để nhận tiêu đề và trả về chuyên mục dự đoán.
    """
    try:
        # Kiểm tra xem mô hình đã được huấn luyện chưa
        required_files = [CLASSIFIER_VECTORIZER_PATH, CLASSIFIER_MODEL_PATH, LABEL_ENCODER_PATH]
        if not all(os.path.exists(p) for p in required_files):
            return jsonify({"error": "Mô hình phân loại chưa được huấn luyện. Vui lòng gọi /train_classifier trước."}), 400
        
        data = request.get_json()
        # Kết hợp title và content để có nhiều ngữ cảnh hơn
        text_to_classify = data.get('title', '') + ' ' + data.get('content', '')

        if not text_to_classify.strip():
            return jsonify({"error": "Cần có title hoặc content."}), 400

        # Tải các mô hình đã lưu
        vectorizer = joblib.load(CLASSIFIER_VECTORIZER_PATH)
        classifier = joblib.load(CLASSIFIER_MODEL_PATH)
        le = joblib.load(LABEL_ENCODER_PATH)

        # Xử lý và dự đoán
        processed_text = preprocess(text_to_classify)
        text_vector = vectorizer.transform([processed_text])
        
        prediction_code = classifier.predict(text_vector)[0]
        prediction_proba = classifier.predict_proba(text_vector).max()
        
        # Giải mã nhãn số thành tên chuyên mục
        predicted_category_name = le.inverse_transform([prediction_code])[0]

        return jsonify({
            "category": predicted_category_name,
            "confidence": float(prediction_proba)
        })

    except Exception as e:
        app.logger.error(f"Lỗi trong quá trình phân loại: {e}")
        return jsonify({"error": str(e)}), 500
# === PHẦN MÃ MỚI CHO MÔ HÌNH PHÂN TÍCH XU HƯỚNG ===
import numpy as np # Đảm bảo bạn đã import numpy

@app.route('/trends', methods=['GET'])
def get_trends():
    """
    Phân tích toàn bộ bài viết để tìm ra các từ khóa có điểm TF-IDF cao nhất.
    Trong thực tế, bạn sẽ lọc các bài viết theo timeframe trước khi xử lý.
    """
    try:
        app.logger.info(f"Bắt đầu phân tích xu hướng thảo luận...")

        # LƯU Ý: Trong hệ thống thực tế, Laravel sẽ chỉ gửi các bài viết trong 24h qua.
        # Ở đây, để đơn giản hóa, chúng ta phân tích trên toàn bộ tệp posts_data.csv.
        df = pd.read_csv('data/posts_data.csv')
        df.dropna(subset=['text'], inplace=True)

        # Tiền xử lý văn bản
        df['cleaned_text'] = df['text'].apply(preprocess)

        # Áp dụng TF-IDF để tính toán tầm quan trọng của từ
        vectorizer = TfidfVectorizer(max_features=1000, stop_words=None, ngram_range=(1, 2)) # xem xét cả cụm 1-2 từ
        tfidf_matrix = vectorizer.fit_transform(df['cleaned_text'])
        
        # Tính tổng điểm TF-IDF cho mỗi từ để đo lường tầm quan trọng tổng thể
        sum_tfidf = tfidf_matrix.sum(axis=0)
        words = vectorizer.get_feature_names_out()
        
        # Tạo DataFrame từ các từ và điểm số của chúng
        trends_df = pd.DataFrame({'keyword': words, 'score': np.asarray(sum_tfidf).ravel()})
        
        # Sắp xếp và lấy 10 từ khóa/cụm từ hàng đầu
        top_trends = trends_df.sort_values(by='score', ascending=False).head(10)

        # Chuyển thành định dạng JSON để trả về
        trends_list = top_trends.to_dict(orient='records')

        return jsonify({"trends": trends_list})

    except Exception as e:
        app.logger.error(f"Lỗi trong quá trình phân tích xu hướng: {e}")
        return jsonify({"error": str(e)}), 500
