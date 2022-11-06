<?php

namespace Database\Seeders;

use App\Models\Post;
use Database\Factories\PostFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->user_id = 1;
        $post->category_id = 4;
        $post->title = "โทรศัพท์หายครับ";
        $post->image = "https://www.j9phone.com/images/content/original-1589270965225.png";
        $post->description = "เป็น Iphone 11 ที่ผมพยายามเก็บตังซื้อมาอย่างยากลำบาก ผมเผลอทำหล่นหายไปตอนไหนก็ไม่รู้ครับ";
        $post->color = "Black";
        $post->brand = "Apple";
        $post->reward = "5000";
        $post->is_lost = 1;
        $post->latitude = 13.845553010524407;
        $post->longitude = 100.57076906928951;
        $post->save();

        $post = new Post();
        $post->user_id = 3;
        $post->category_id = 1;
        $post->title = "กระเป๋าตังหล่นหาย!!";
        $post->image = "https://backend.central.co.th/media/catalog/product/b/0/b07c864237c5f6f1910957ee4985f29386ee11c3_mkp0851416dummy.jpg";
        $post->description = "กระเป๋าตังที่มีของสำคัญเต็มไปหมด ไม่ว่าจะเป็นรูปภาพ เงินสด บัตร";
        $post->color = "Brown";
        $post->brand = "Calvin Klein";
        $post->datetime = "2022-08-07 13:34:00";
        $post->reward = "1000";
        $post->is_lost = 1;
        $post->is_done = 1;
        $post->latitude = 13.845562419647932;
        $post->longitude = 100.57147261366275;
        $post->save();

        $post = new Post();
        $post->user_id = 4;
        $post->category_id = 6;
        $post->title = "หนังสือที่อ่านประจำหาย";
        $post->image = "https://www.labnol.org/images/2008/wikipedia-book.jpg";
        $post->description = "เหมือนจะกินข้าวแล้ววางไว้ที่บาร์วิศวะ";
        $post->color = "Indigo";
        $post->datetime = "2022-10-19 11:33";
        $post->is_lost = 1;
        $post->latitude = 13.84650854659504;
        $post->longitude = 100.56938646981465;
        $post->save();

        $post = new Post();
        $post->user_id = 1;
        $post->category_id = 8;
        $post->title = "เจอกระเป๋าสะพายข้างวางอยู่ที่บาร์วิทย์";
        $post->image = "https://p-th.ipricegroup.com/14acafbe18c84d1c03d908c1e670be999903dbaa_0.jpg?position=4";
        $post->description = "เจอวางไว้ที่โต๊ะกินข้าวที่บาร์วิทย์ ไม่มีใครหยิบประมาณ 45 นาทีเลยคิดว่ามีคนลืมไว้";
        $post->color = "Black";
        $post->brand = "Adidas";
        $post->datetime = "2022-09-16 12:53";
        $post->is_lost = 0;
        $post->latitude = 13.845877894818347;
        $post->longitude = 100.57114837764306;
        $post->save();

        $post = new Post();
        $post->user_id = 4;
        $post->category_id = 10;
        $post->title = "มี Powerbank วางอยู่ในห้องเรียน";
        $post->image = "https://media.shopat24.com/pdmain/426405_00_Eloop_Power_Bank_30000mAh_E29_Black.jpg";
        $post->description = "มีคนลืม Powerbank ไว้ในห้องเรียน";
        $post->color = "Black";
        $post->is_lost = 0;
        $post->is_done = 1;
        $post->latitude = 13.847143291639274;
        $post->longitude = 100.57092625186885;
        $post->save();

        $post = new Post();
        $post->user_id = 3;
        $post->category_id = 5;
        $post->title = "มีคนลืม Ipad ที่บาร์ใหม่";
        $post->image = "https://media-cdn.bnn.in.th/183363/iPad_Air_Wi-Fi_Blue_2-square_medium.jpg";
        $post->description = "มีคนลืม Ipad ไว้ที่บาร์ใหม่ ยังไม่มีใครเดินกลับมาเอาเลย";
        $post->color = "Cyan";
        $post->datetime = "2022-10-01 10:25:48";
        $post->is_lost = 0;
        $post->latitude = 13.848775960319665;
        $post->longitude = 100.5670966643671;
        $post->save();

        $post = new Post();
        $post->user_id = 5;
        $post->category_id = 9;
        $post->title = "ลืมเสื้อกีฬาไว้ที่สนามกีฬา";
        $post->image = "https://f.btwcdn.com/store-35589/product/1f4ae293-6b41-d1a2-4c0a-5e8702a282d4.jpg";
        $post->description = "กำลังเดินกลับบ้านพึ่งนึกได้ว่าลืมเสื้อกีฬาที่สนามกีฬา พอเดินกลับไปเอามันก็ไม่อยู่แล้ว";
        $post->color = "Light Blue";
        $post->datetime = "2022-11-02 16:34:14";
        $post->is_lost = 1;
        $post->latitude = 13.850294786331887;
        $post->longitude = 100.56531468366704;
        $post->save();

        $post = new Post();
        $post->user_id = 6;
        $post->category_id = 3;
        $post->title = "เจอกุญแจของใครไม่รู้ตกอยู่";
        $post->image = "https://shops-image.s3-ap-southeast-1.amazonaws.com/d/ddknives/img-lib/spd_20170126125649_b.jpg";
        $post->description = "กำลังเดินไปที่ BTS ม.เกษตร แล้วเจอกุญแจตกอยู่ตรงถนนหน้าอนุสาวรีย์สามบูรพาจารย์";
        $post->datetime = "2022-11-02 17:12:03";
        $post->is_lost = 0;
        $post->latitude = 13.842399148178862;
        $post->longitude = 100.57313046493127;
        $post->save();
    }
}
