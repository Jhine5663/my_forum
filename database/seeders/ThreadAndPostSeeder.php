<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Thread;
use App\Models\Post;

class ThreadAndPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả users và categories đã tạo để sử dụng
        $users = User::all();
        $categories = Category::all();

        // Lấy mảng dữ liệu thô
        $threadsData = $this->getThreadsData();

        foreach ($threadsData as $data) {
            // Tìm category tương ứng với tên
            $category = $categories->where('name', $data['category'])->first();
            // Lấy một user ngẫu nhiên để đăng bài
            $user = $users->random();

            // Nếu category tồn tại, tiến hành tạo thread và post
            if ($category) {
                $thread = Thread::create([
                    'title' => $data['title'],
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);

                Post::create([
                    'thread_id' => $thread->id,
                    'user_id' => $user->id,
                    'content' => $data['content'],
                ]);
            }
        }
    }

    /**
     * Chuẩn bị một bộ dữ liệu lớn và được phân cụm
     */
    private function getThreadsData(): array
    {
        return [
            // === Cụm Stardew Valley ===
            ['category' => 'Stardew Valley', 'title' => 'Mẹo trồng cây lợi nhuận nhất mùa hè?', 'content' => 'Mọi người ơi, mùa hè trong Stardew Valley nên trồng cây gì để kiếm được nhiều tiền nhất vậy? Mình đang phân vân giữa blueberry và starfruit.'],
            ['category' => 'Stardew Valley', 'title' => 'Hướng dẫn tặng quà cho Shane', 'content' => 'Mình đang muốn kết bạn với Shane, không biết anh ấy thích quà gì nhất nhỉ? Cho mình xin ít kinh nghiệm với.'],
            ['category' => 'Stardew Valley', 'title' => 'Làm sao để xuống sâu trong Skull Cavern?', 'content' => 'Mình xuống Skull Cavern khó quá, toàn bị quái vật đánh bại. Có mẹo nào để đi sâu hơn không mọi người?'],
            ['category' => 'Stardew Valley', 'title' => 'Bản mod Stardew Valley Expanded có hay không?', 'content' => 'Thấy mọi người hay nhắc đến mod SVE, nó có thêm nhiều nội dung không ạ? Cài đặt có phức tạp không?'],
            ['category' => 'Stardew Valley', 'title' => 'Chia sẻ thiết kế nông trại đẹp', 'content' => 'Đây là nông trại mình đã trang trí sau 3 năm chơi. Mọi người vào xem và góp ý nhé!'],
            ['category' => 'Stardew Valley', 'title' => 'Hoàn thành Community Center trong năm đầu, có khả thi?', 'content' => 'Mình đang đặt mục tiêu hoàn thành Community Center ngay trong năm đầu tiên. Có ai làm được chưa và có lời khuyên gì không?'],
            ['category' => 'Stardew Valley', 'title' => 'Câu cá huyền thoại (Legendary Fish) ở đâu?', 'content' => 'Mình đã câu được hầu hết các loại cá rồi, giờ chỉ còn mấy con cá huyền thoại nữa thôi. Ai biết vị trí và mùa câu của chúng không?'],
            ['category' => 'Stardew Valley', 'title' => 'Thảo luận về các sự kiện (Heart Event) của nhân vật', 'content' => 'Mọi người thích Heart Event của nhân vật nào nhất? Mình thì thấy sự kiện của Penny rất cảm động.'],
            ['category' => 'Stardew Valley', 'title' => 'Cách kiếm Iridium Ore hiệu quả nhất', 'content' => 'Ngoài Skull Cavern ra thì còn cách nào để farm Iridium Ore nhanh không mọi người?'],
            ['category' => 'Stardew Valley', 'title' => 'Heo và Dầu Truffle: Nguồn thu nhập khủng', 'content' => 'Đầu tư nuôi heo có vẻ tốn kém ban đầu nhưng thu lại dầu truffle giá trị thật. Mọi người thấy có đáng để đầu tư không?'],

            // === Cụm Hollow Knight ===
            ['category' => 'Hollow Knight', 'title' => 'Kẹt ở boss Hornet lần 2, ai giúp với!', 'content' => 'Mình đánh Hornet ở Kingdom\'s Edge mãi không qua. Kỹ năng của boss nhanh quá, có chiến thuật nào hiệu quả không?'],
            ['category' => 'Hollow Knight', 'title' => 'Bàn luận về cốt truyện và The Pale King', 'content' => 'Theo mọi người, The Pale King là một vị vua tốt hay một kẻ độc tài? Cốt truyện của game sâu sắc thật sự.'],
            ['category' => 'Hollow Knight', 'title' => 'Vị trí của các mảnh Vessel Fragment', 'content' => 'Mình đang cần tìm Vessel Fragment để tăng máu, đã tìm được vài cái rồi. Ai biết vị trí tất cả không chỉ mình với.'],
            ['category' => 'Hollow Knight', 'title' => 'Charm build nào là mạnh nhất?', 'content' => 'Mọi người hay dùng bộ charm nào khi đi khám phá và khi đánh boss? Mình đang dùng Quick Slash và Unbreakable Strength.'],
            ['category' => 'Hollow Knight', 'title' => 'Path of Pain có thực sự cần thiết?', 'content' => 'Mình nghe nói Path of Pain cực khó. Hoàn thành nó có ảnh hưởng đến kết thúc game không?'],
            ['category' => 'Hollow Knight', 'title' => 'Thảo luận về các kết thúc của game (endings)', 'content' => 'Hollow Knight có nhiều ending quá. Mọi người thấy ending nào là "true ending" và ấn tượng nhất?'],
            ['category' => 'Hollow Knight', 'title' => 'Cách đối phó với bọn Primal Aspid đáng ghét', 'content' => 'Có ai ghét con Primal Aspid ở Kingdom\'s Edge như mình không? Nó bắn 3 tia khó né quá, có cách nào trị nó không?'],
            ['category' => 'Hollow Knight', 'title' => 'Lore về The Radiance và sự lây nhiễm', 'content' => 'Mình vẫn chưa hiểu rõ về The Radiance. Tại sao nó lại gây ra sự lây nhiễm cho Hallownest?'],
            ['category' => 'Hollow Knight', 'title' => 'Hướng dẫn farm Geo nhanh', 'content' => 'Mình đang thiếu Geo để mua charm và sửa Unbreakable charm. Có khu vực nào farm Geo nhanh không mọi người?'],
            ['category' => 'Hollow Knight', 'title' => 'Godmaster DLC: Thử thách cho các "thánh nhân"', 'content' => 'Ai đã thử thách bản thân với Godhome và các Pantheon chưa? Thực sự là nội dung cuối game cực kỳ khó nhằn.'],

            // === Cụm Lập trình Game (Unity) ===
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Lỗi NullReferenceException khi di chuyển nhân vật', 'content' => 'Mình viết code cho nhân vật di chuyển bằng Rigidbody2D mà cứ bị lỗi NullReferenceException. Đây là đoạn code của mình, ai xem giúp với.'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Cách tạo AI cho quái vật đơn giản?', 'content' => 'Mình muốn làm quái vật biết đi tuần tra và đuổi theo người chơi khi thấy. Nên bắt đầu từ đâu vậy mọi người?'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Sử dụng Tilemap để tạo màn chơi hiệu quả', 'content' => 'Tilemap trong Unity rất mạnh. Đây là hướng dẫn của mình về cách dùng Rule Tiles để vẽ level nhanh hơn.'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Làm sao để tối ưu game cho mobile?', 'content' => 'Game của mình chạy trên PC thì mượt mà build ra điện thoại thì giật lag. Có những cách tối ưu nào phổ biến không?'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Singleton Pattern trong Unity - Nên hay không?', 'content' => 'Mình thấy nhiều người dùng Singleton để quản lý game, nhưng cũng có người nói nó là anti-pattern. Mọi người nghĩ sao?'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Sử dụng Coroutines để xử lý các hành động theo thời gian', 'content' => 'Mình muốn làm một hành động chờ 2 giây rồi mới thực hiện tiếp. Dùng Coroutines có phải là cách tốt nhất không?'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Lưu và tải game (Save/Load) trong Unity', 'content' => 'Có những cách nào để lưu game trong Unity? Nên dùng PlayerPrefs, JSON hay BinaryFormatter?'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Hỏi về cách sử dụng Animator và Animation Events', 'content' => 'Làm sao để gọi một hàm trong script ngay tại một frame nhất định của animation? Mình nghe nói có thể dùng Animation Events.'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Sự khác biệt giữa Update, FixedUpdate và LateUpdate', 'content' => 'Mình vẫn còn hơi mơ hồ về 3 hàm này. Khi nào thì nên dùng cái nào? Đặc biệt là với các xử lý vật lý.'],
            ['category' => 'Lập trình Game (Unity)', 'title' => 'Tạo giao diện người dùng (UI) với Canvas', 'content' => 'Mình đang gặp khó khăn trong việc làm cho UI co giãn theo các kích thước màn hình khác nhau. Cần chú ý những gì ở Canvas Scaler?'],

            // === Cụm Pixel Art & Thiết kế ===
            ['category' => 'Pixel Art & Thiết kế', 'title' => '[Showcase] Nhân vật hiệp sĩ pixel art mình mới vẽ', 'content' => 'Mình mới tập vẽ pixel art và đây là sản phẩm đầu tay. Mọi người cho mình xin nhận xét để cải thiện nhé.'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Nên dùng phần mềm nào để vẽ pixel art?', 'content' => 'Mình đang phân vân giữa Aseprite và Photoshop. Người mới bắt đầu thì nên chọn cái nào?'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Thảo luận về lý thuyết màu sắc trong pixel art', 'content' => 'Việc chọn bảng màu rất quan trọng. Mọi người thường tìm kiếm và tạo palette màu như thế nào?'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Kỹ thuật làm animation đi bộ (walk cycle)', 'content' => 'Mình đang gặp khó khăn khi làm animation đi bộ cho nhân vật, nó không được mượt. Ai có kinh nghiệm chia sẻ với.'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Độ phân giải (resolution) nào là phù hợp cho game pixel?', 'content' => 'Mình nên bắt đầu với canvas kích thước bao nhiêu? 16x16, 32x32 hay 64x64 cho một nhân vật?'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Kỹ thuật Anti-Aliasing thủ công trong pixel art', 'content' => 'Làm thế nào để làm các đường cong trông mượt hơn trong pixel art mà không làm mất đi vẻ đẹp của nó?'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Chia sẻ các bảng màu (color palettes) đẹp', 'content' => 'Tổng hợp một số bảng màu đẹp mà mình hay dùng, từ phong cách retro đến hiện đại. Mọi người cùng chia sẻ nhé.'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Làm thế nào để vẽ tileset cho game platformer?', 'content' => 'Mình muốn vẽ một bộ tileset đất và cỏ cho game platformer. Cần chú ý những gì để chúng có thể kết hợp với nhau một cách liền mạch?'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => 'Phân tích phong cách đồ họa của game Shovel Knight', 'content' => 'Hãy cùng phân tích xem điều gì làm cho phong cách đồ họa của Shovel Knight trở nên đặc biệt và hoài cổ như vậy.'],
            ['category' => 'Pixel Art & Thiết kế', 'title' => '[Feedback] Hiệu ứng nổ (explosion) pixel art', 'content' => 'Mình vừa làm một animation hiệu ứng nổ. Mọi người xem và cho mình góp ý để nó trông "đã" hơn nhé.'],

            // === Cụm Celeste ===
            ['category' => 'Celeste', 'title' => 'Thảo luận về các màn C-Sides của Celeste', 'content' => 'Có ai ở đây đã hoàn thành các màn C-Sides chưa? Thực sự là một thử thách kinh hoàng nhưng cũng rất thỏa mãn.'],
            ['category' => 'Celeste', 'title' => 'Ý nghĩa đằng sau câu chuyện của Madeline và Badeline', 'content' => 'Mình rất ấn tượng với cách Celeste kể chuyện về sức khỏe tâm thần. Mọi người cảm nhận thế nào về mối quan hệ giữa Madeline và Badeline?'],
            ['category' => 'Celeste', 'title' => 'Kỹ thuật Wavedash và Hyperdash trong Celeste', 'content' => 'Mình đang tập các kỹ thuật di chuyển nâng cao như Wavedash. Có ai có video hướng dẫn hoặc mẹo để thực hiện dễ dàng hơn không?'],
            ['category' => 'Celeste', 'title' => 'Tìm đủ 175 quả dâu tây - Cảm giác thật tuyệt!', 'content' => 'Sau bao ngày tháng, cuối cùng mình cũng đã thu thập đủ 175 quả dâu tây. Chia sẻ niềm vui với mọi người!'],
            ['category' => 'Celeste', 'title' => 'Bản nhạc nền nào trong Celeste là hay nhất?', 'content' => 'Nhạc của game này quá đỉnh. Theo mọi người, track "First Steps" hay "Reach for the Summit" hay hơn?'],
            ['category' => 'Celeste', 'title' => 'Nhân vật Mr. Oshiro và câu chuyện của ông ấy', 'content' => 'Mình thấy khá thương cho nhân vật Mr. Oshiro. Mọi người nghĩ sao về câu chuyện của hồn ma này?'],
            ['category' => 'Celeste', 'title' => 'So sánh độ khó giữa B-Sides và C-Sides', 'content' => 'Theo cảm nhận của mọi người, các màn chơi ở B-Sides hay C-Sides khó hơn? Mình thấy C-Sides ngắn nhưng cực kỳ oái oăm.'],
            ['category' => 'Celeste', 'title' => 'Làm sao để tìm được tất cả Crystal Hearts?', 'content' => 'Mình còn thiếu vài quả tim pha lê nữa mà không biết cách lấy. Có cái nào ẩn giấu quá kỹ không?'],
            ['category' => 'Celeste', 'title' => 'Chapter 9 (Farewell) - Một lời chia tay đầy cảm xúc', 'content' => 'Bản DLC Farewell thực sự là một thử thách cuối cùng và cũng là một lời chia tay trọn vẹn. Cảm xúc của mọi người khi hoàn thành nó thế nào?'],
            ['category' => 'Celeste', 'title' => 'Celeste 2 có khả năng được thực hiện không?', 'content' => 'Liệu có cơ hội nào cho phần 2 của Celeste không nhỉ? Hay câu chuyện đã kết thúc một cách hoàn hảo rồi?'],

            // === Cụm Terraria ===
            ['category' => 'Terraria', 'title' => 'Thứ tự đánh boss trong Terraria cho người mới', 'content' => 'Mình mới chơi Terraria và hơi bị ngợp vì có quá nhiều boss. Mọi người cho mình xin thứ tự đánh boss hợp lý được không?'],
            ['category' => 'Terraria', 'title' => 'Làm sao để chuẩn bị cho Hardmode?', 'content' => 'Mình sắp đánh Wall of Flesh. Cần chuẩn bị những gì để không bị sốc khi vào Hardmode vậy mọi người?'],
            ['category' => 'Terraria', 'title' => 'Build đồ cho class Summoner ở giai đoạn cuối game', 'content' => 'Mình đang chơi class Summoner và đã đến giai đoạn cuối. Nên dùng vũ khí, giáp và phụ kiện gì để tối ưu sát thương?'],
            ['category' => 'Terraria', 'title' => 'Chia sẻ các mẫu nhà đẹp trong Terraria', 'content' => 'Mình không có hoa tay lắm trong việc xây nhà. Ai có mẫu nhà đẹp, độc đáo thì chia sẻ cho mình tham khảo với.'],
            ['category' => 'Terraria', 'title' => 'Cách farm Ankh Shield hiệu quả', 'content' => 'Cái Ankh Shield cần quá nhiều nguyên liệu. Có cách nào farm các nguyên liệu của nó một cách nhanh chóng không?'],
            ['category' => 'Terraria', 'title' => 'Plantera - Con trùm khó chịu nhất Hardmode?', 'content' => 'Mình thấy Plantera là con boss khó chịu nhất vì không gian chiến đấu hẹp. Mọi người có đồng ý không?'],
            ['category' => 'Terraria', 'title' => 'Sự kiện Blood Moon và cách tận dụng nó', 'content' => 'Ngoài việc quái vật trở nên hung dữ hơn, sự kiện Blood Moon còn có lợi ích gì không? Làm sao để farm hiệu quả trong đêm này?'],
            ['category' => 'Terraria', 'title' => 'Expert Mode và Master Mode - Thử thách thực sự', 'content' => 'Chơi ở độ khó Expert và Master thật sự khác biệt. Các vật phẩm độc quyền từ các độ khó này có đáng để cày cuốc không?'],
            ['category' => 'Terraria', 'title' => 'Zenith - Thanh kiếm tối thượng và cách chế tạo', 'content' => 'Hành trình chế tạo Zenith thật gian nan. Cảm giác của mọi người khi lần đầu cầm trên tay thanh kiếm này thế nào?'],
            ['category' => 'Terraria', 'title' => 'NPC nào là hữu ích nhất trong game?', 'content' => 'Theo bạn, trong tất cả các NPC, ai là người bạn muốn có trong làng của mình nhất? Mình chọn Goblin Tinkerer.'],

            // === Cụm Âm nhạc & Sound Design ===
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Các thư viện âm thanh miễn phí cho game dev', 'content' => 'Tổng hợp các nguồn sound effect và nhạc nền miễn phí mà các nhà phát triển game có thể sử dụng cho dự án của mình.'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Nên dùng phần mềm nào để sáng tác nhạc Chiptune/8-bit?', 'content' => 'Mình muốn tự làm nhạc cho game pixel art của mình. Có phần mềm nào dễ dùng cho người mới bắt đầu không? Mình nghe nói về Bosca Ceoil.'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Kỹ thuật tạo sound effect cho bước chân trên các bề mặt khác nhau', 'content' => 'Làm sao để tạo ra âm thanh bước chân trên cỏ, trên đá, trên gỗ... một cách khác biệt và chân thực?'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Phân tích nhạc nền của game Undertale', 'content' => 'Nhạc của Undertale sử dụng leitmotif rất hay. Hãy cùng phân tích cách Toby Fox đã lồng ghép các giai điệu để kể chuyện.'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'FMOD và Wwise - Khi nào nên dùng Middleware âm thanh?', 'content' => 'Dự án game của mình đang lớn dần. Có nên tích hợp FMOD hoặc Wwise để quản lý âm thanh chuyên nghiệp hơn không?'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Làm thế nào để tạo ra một bản nhạc boss "epic"?', 'content' => 'Mình muốn sáng tác một bản nhạc cho trận đấu trùm thật hoành tráng. Cần những yếu tố gì để tạo ra cảm giác căng thẳng và kịch tính?'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Tầm quan trọng của sự im lặng trong sound design', 'content' => 'Đôi khi, không có âm thanh lại là một công cụ sound design cực kỳ mạnh mẽ. Mọi người nghĩ sao về điều này?'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Cách nén (compress) file âm thanh mà không làm giảm chất lượng nhiều', 'content' => 'File âm thanh của mình có dung lượng lớn quá, ảnh hưởng đến kích thước game. Có cách nào để giảm dung lượng file mà chất lượng vẫn tốt không?'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => 'Luật bản quyền âm nhạc cho game indie', 'content' => 'Khi sử dụng nhạc miễn phí trên mạng, cần chú ý những gì về giấy phép Creative Commons?'],
            ['category' => 'Âm nhạc & Sound Design', 'title' => '[Feedback] Xin góp ý cho bản nhạc nền làng quê em mới sáng tác', 'content' => 'Em mới viết một bản nhạc cho ngôi làng trong game RPG của em. Mọi người nghe thử và cho em xin nhận xét nhé.'],

            // === Cụm Cốt truyện & Phân tích Game ===
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Top 5 game 2D có cốt truyện hay nhất bạn từng chơi', 'content' => 'Hãy cùng liệt kê và thảo luận về những tựa game 2D có cốt truyện để lại ấn tượng sâu sắc nhất trong lòng bạn.'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Cái kết của game INSIDE - Ai có thể giải thích được không?', 'content' => 'Mình vừa chơi xong INSIDE và cái kết của nó làm mình suy nghĩ rất nhiều. Mọi người có giả thuyết gì về ý nghĩa của nó không?'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Lối kể chuyện qua môi trường (Environmental Storytelling) trong game 2D', 'content' => 'Game nào theo bạn đã sử dụng môi trường để kể chuyện một cách xuất sắc nhất? Mình nghĩ đến Hyper Light Drifter.'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Phân tích nhân vật GLaDOS trong series Portal', 'content' => 'Mặc dù Portal không phải game 2D, nhưng GLaDOS là một trong những phản diện hay nhất. Điều gì làm cho nhân vật này trở nên đặc biệt?'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => '"Show, don\'t tell" - Áp dụng trong việc viết kịch bản game', 'content' => 'Làm thế nào để kể chuyện trong game một cách tinh tế mà không cần dùng đến quá nhiều lời thoại hay văn bản giải thích?'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Giả thuyết về The Knight trong Hollow Knight', 'content' => 'The Knight thực sự là một Vessel "thuần khiết" (pure) hay không? Có nhiều chi tiết trong game cho thấy điều ngược lại.'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Sự lựa chọn của người chơi có thực sự ảnh hưởng đến cốt truyện?', 'content' => 'Nhiều game quảng cáo về các lựa chọn có ảnh hưởng lớn, nhưng cuối cùng vẫn dẫn đến một vài cái kết định sẵn. Mọi người nghĩ sao?'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Bốn bức tường thứ tư (The Fourth Wall) bị phá vỡ trong game', 'content' => 'Bạn ấn tượng nhất với game nào đã phá vỡ bức tường thứ tư một cách thông minh? Ví dụ như Undertale hay Doki Doki Literature Club.'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Xây dựng một thế giới (World-building) hấp dẫn', 'content' => 'Cần những yếu tố gì để xây dựng một thế giới trong game có chiều sâu và khiến người chơi muốn khám phá?'],
            ['category' => 'Cốt truyện & Phân tích Game', 'title' => 'Cái thiện và cái ác có thực sự rõ ràng trong game?', 'content' => 'Nhiều game có những nhân vật và phe phái "màu xám", không hoàn toàn tốt cũng không hoàn toàn xấu. Đây có phải là xu hướng kể chuyện hiện đại?'],

            // === Cụm Tìm Đồng Đội ===
            ['category' => 'Tìm Đồng Đội', 'title' => 'Cần tìm 1 artist cho dự án game platformer', 'content' => 'Nhóm mình đang có 1 lập trình viên, cần tìm một bạn artist có kinh nghiệm vẽ pixel art để hợp tác làm game platformer giải đố.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Dự án game RPG cần lập trình viên Unity', 'content' => 'Mình là game designer đã có kịch bản và art đầy đủ, cần tìm một bạn dev Unity để hiện thực hóa dự án. Có chia sẻ doanh thu.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Tìm người viết cốt truyện cho game visual novel', 'content' => 'Mình là artist và có thể lập trình, đang tìm một bạn writer có đam mê để cùng xây dựng một câu chuyện visual novel ý nghĩa.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Game Jam sắp tới, lập team thôi!', 'content' => 'Cuối tuần này có sự kiện game jam online. Mình là dev, cần tìm artist và sound designer để lập team tham gia cho vui. Ai có hứng thú không?'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Dự án game kinh dị 2D tìm sound designer', 'content' => 'Bọn mình đang làm một game kinh dị 2D và rất cần một bạn có khả năng tạo ra không khí rùng rợn bằng âm thanh.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Tìm tester cho bản alpha của game chiến thuật', 'content' => 'Game của mình đã có một bản build có thể chơi được. Cần vài bạn chơi thử và cho mình xin feedback để cân bằng game.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Lập trình viên Godot tìm dự án để tham gia', 'content' => 'Mình có kinh nghiệm dùng Godot Engine và đang muốn tham gia một dự án game 2D nhỏ để học hỏi thêm. Ai có team đang tuyển không?'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Tìm animator cho nhân vật game đối kháng', 'content' => 'Mình đã có thiết kế nhân vật, cần một bạn animator có thể tạo ra các animation chiến đấu mượt mà và uy lực.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Dự án mã nguồn mở - Cùng nhau xây dựng một game engine 2D', 'content' => 'Mình đang bắt đầu một dự án mã nguồn mở để xây dựng một game engine 2D đơn giản bằng C++. Mời các bạn có cùng đam mê tham gia.'],
            ['category' => 'Tìm Đồng Đội', 'title' => 'Cần người dịch game từ tiếng Việt sang tiếng Anh', 'content' => 'Game của mình sắp hoàn thành và mình muốn phát hành ra thị trường quốc tế. Cần tìm một bạn có khả năng dịch thuật tốt.'],

            // === Cụm Showcase Dự Án ===
            ['category' => 'Showcase Dự Án', 'title' => '[Demo] Game giải đố "Mèo Lạc Lối"', 'content' => 'Chào mọi người, đây là bản demo đầu tiên của game giải đố mình đang phát triển. Mọi người chơi thử và cho mình xin ý kiến nhé!'],
            ['category' => 'Showcase Dự Án', 'title' => '[Video] Gameplay đầu tiên của dự án Metroidvania của mình', 'content' => 'Sau 6 tháng phát triển, mình đã có một đoạn video gameplay ngắn. Mọi người xem và cho mình biết cảm nhận ban đầu nhé.'],
            ['category' => 'Showcase Dự Án', 'title' => '[Art] Thiết kế nhân vật chính cho game RPG', 'content' => 'Đây là concept art cho nhân vật chính trong game RPG của mình. Mọi người thấy phong cách này có ổn không?'],
            ['category' => 'Showcase Dự Án', 'title' => '[Screenshot Saturday] Vài hình ảnh từ game nông trại mình đang làm', 'content' => 'Hưởng ứng ngày #ScreenshotSaturday, mình chia sẻ một vài góc trong game nông trại 2D của mình.'],
            ['category' => 'Showcase Dự Án', 'title' => 'Phát hành game đầu tay trên Itch.io!', 'content' => 'Cuối cùng thì game mình làm trong 1 năm qua cũng đã được phát hành trên Itch.io. Mời mọi người chơi thử và ủng hộ!'],
            ['category' => 'Showcase Dự Án', 'title' => '[Devlog] Quá trình thêm hệ thống thời tiết vào game', 'content' => 'Mình vừa hoàn thành việc thêm mưa và tuyết vào game. Đây là video devlog ghi lại quá trình thực hiện.'],
            ['category' => 'Showcase Dự Án', 'title' => 'Xin feedback về giao diện người dùng (UI)', 'content' => 'Mình mới thiết kế xong UI cho game. Mọi người nhìn vào có thấy dễ hiểu và thuận tiện không?'],
            ['category' => 'Showcase Dự Án', 'title' => '[Animation] Chuỗi animation tấn công của kẻ thù', 'content' => 'Mình vừa hoàn thành bộ animation cho một con quái trong game. Mọi người thấy nó đã đủ "uy hiếp" chưa?'],
            ['category' => 'Showcase Dự Án', 'title' => 'Thử nghiệm hệ thống dialog và nhiệm vụ', 'content' => 'Mình đang test hệ thống nhiệm vụ và hội thoại. Mọi người xem video và cho mình biết nó có dễ theo dõi không nhé.'],
            ['category' => 'Showcase Dự Án', 'title' => '[Music] Bản nhạc nền cho màn chơi trong rừng', 'content' => 'Mình vừa sáng tác xong bản nhạc cho màn chơi trong rừng. Mọi người nghe thử xem nó có tạo được không khí bí ẩn, huyền ảo không.'],
        ];
    }
}
