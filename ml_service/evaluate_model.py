import pandas as pd
import joblib
import matplotlib.pyplot as plt
from wordcloud import WordCloud
from sklearn.manifold import TSNE
import numpy as np
import re

# --- CÁC HÀM TIỀN XỬ LÝ VÀ ĐÁNH GIÁ ---

def preprocess(text):
    """Hàm tiền xử lý văn bản (phải giống với hàm trong app.py)."""
    if not isinstance(text, str):
        return ""
    text = text.lower()
    text = re.sub(r'\W', ' ', text)
    text = re.sub(r'\s+', ' ', text)
    return text.strip()

def plot_word_cloud(vectorizer, cleaned_texts):
    """Vẽ biểu đồ Word Cloud từ các từ khóa quan trọng."""
    # Tạo một chuỗi lớn chứa tất cả văn bản
    long_text = ' '.join(cleaned_texts)
    
    wordcloud = WordCloud(
        width=800, 
        height=400, 
        background_color='white',
        max_words=100
    ).generate(long_text)
    
    plt.figure(figsize=(10, 5))
    plt.imshow(wordcloud, interpolation='bilinear')
    plt.axis('off')
    plt.title('Biểu đồ Word Cloud các từ khóa phổ biến')
    plt.savefig('evaluation_wordcloud.png') # Lưu biểu đồ
    print("-> Đã lưu biểu đồ Word Cloud tại 'evaluation_wordcloud.png'")

def evaluate_recommendations_qualitatively(df, vectorizer, tfidf_matrix, post_ids):
    """Chọn ra vài bài viết và in ra các gợi ý cùng điểm tương đồng."""
    from sklearn.metrics.pairwise import cosine_similarity

    # Chọn 3 bài viết ngẫu nhiên để làm ví dụ
    sample_indices = np.random.choice(len(post_ids), 3, replace=False)

    print("\n--- PHẦN 2: ĐÁNH GIÁ ĐỊNH TÍNH (VÍ DỤ CỤ THỂ) ---")
    for index in sample_indices:
        post_id = post_ids[index]
        post_content = df[df['post_id'] == post_id]['text'].iloc[0]
        
        # In thông tin bài viết gốc
        print("\n==========================================================")
        print(f"[*] BÀI VIẾT GỐC (ID: {post_id}): {post_content[:100]}...")
        print("----------------------------------------------------------")
        
        # Tính toán độ tương đồng
        content_vector = tfidf_matrix[index]
        similarities = cosine_similarity(content_vector, tfidf_matrix).flatten()
        
        # Lấy 5 gợi ý hàng đầu (bỏ qua chính nó)
        similar_indices = similarities.argsort()[-6:-1][::-1]
        
        print("TOP 5 BÀI VIẾT GỢI Ý:")
        for i in similar_indices:
            rec_post_id = post_ids[i]
            rec_post_content = df[df['post_id'] == rec_post_id]['text'].iloc[0]
            similarity_score = similarities[i]
            
            # In ra gợi ý và điểm số
            print(f"  - (ID: {rec_post_id}) | Điểm tương đồng: {similarity_score:.4f} | Nội dung: {rec_post_content[:70]}...")

def plot_tsne_clustering(tfidf_matrix, df):
    """Vẽ biểu đồ phân cụm các bài viết bằng t-SNE."""
    print("\n--- PHẦN 3: VẼ BIỂU ĐỒ PHÂN CỤM (t-SNE) ---")
    print("Đây là bước tốn thời gian nhất, vui lòng chờ...")
    
    # Giảm chiều dữ liệu xuống 2 chiều để vẽ
    tsne = TSNE(n_components=2, random_state=42, perplexity=min(30, tfidf_matrix.shape[0] - 1))
    tsne_results = tsne.fit_transform(tfidf_matrix.toarray())
    
    # === SỬA LỖI Ở ĐÂY ===
    # Lấy tên chuyên mục và mã hóa nó thành số để tô màu
    df['category_code'] = df['category_name'].astype('category').cat.codes
    category_names = df['category_name'].astype('category').cat.categories
    num_categories = len(category_names)

    plt.figure(figsize=(14, 10))
    # Tô màu các điểm theo mã chuyên mục (category_code)
    scatter = plt.scatter(tsne_results[:, 0], tsne_results[:, 1], c=df['category_code'], 
                          cmap=plt.cm.get_cmap('viridis', num_categories), alpha=0.7)
    
    plt.title('Biểu đồ phân cụm các bài viết theo chuyên mục (t-SNE)', fontsize=16)
    plt.xlabel('Thành phần t-SNE 1')
    plt.ylabel('Thành phần t-SNE 2')
    
    # Tạo chú thích (legend) dựa trên tên chuyên mục
    plt.colorbar(scatter, ticks=range(num_categories), label='Mã chuyên mục').set_ticklabels(category_names)
    
    plt.grid(True)
    plt.savefig('evaluation_clustering.png')
    print("-> Đã lưu biểu đồ phân cụm tại 'evaluation_clustering.png'")

# --- HÀM MAIN ĐỂ CHẠY ĐÁNH GIÁ ---

def main():
    print("Bắt đầu quá trình đánh giá mô hình gợi ý...")

    # Tải dữ liệu và mô hình đã huấn luyện
    try:
        df = pd.read_csv('data/posts_data.csv')
        vectorizer = joblib.load('models/tfidf_vectorizer.joblib')
        tfidf_matrix = joblib.load('models/tfidf_matrix.joblib')
        post_ids = joblib.load('models/post_ids.joblib')
    except FileNotFoundError:
        print("Lỗi: Không tìm thấy tệp dữ liệu hoặc mô hình. Hãy chắc chắn bạn đã chạy /train trước.")
        return

    df['cleaned_text'] = df['text'].apply(preprocess)
    
    print(f"\n--- PHẦN 1: THỐNG KÊ DỮ LIỆU ---")
    print(f"Tổng số bài viết trong tập dữ liệu: {len(df)}")
    total_words = df['cleaned_text'].apply(lambda x: len(x.split())).sum()
    print(f"Tổng số từ (sau khi làm sạch): {total_words}")
    
    # 1. Vẽ Word Cloud
    plot_word_cloud(vectorizer, df['cleaned_text'])

    # 2. Đánh giá định tính
    evaluate_recommendations_qualitatively(df, vectorizer, tfidf_matrix, post_ids)
    
    # 3. Vẽ biểu đồ phân cụm
    if tfidf_matrix.shape[0] > 30: # t-SNE yêu cầu số mẫu phải lớn hơn perplexity
        plot_tsne_clustering(tfidf_matrix, df)
    else:
        print("\nKhông đủ dữ liệu để vẽ biểu đồ phân cụm (cần > 30 bài viết).")

if __name__ == '__main__':
    main()