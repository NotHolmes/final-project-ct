#แนะนำโปรเจคสั้นๆ
    
#สมาชิกกลุ่ม CT
1. นายซาฮิล ชูดวง รหัสนิสิต 6310406281 (NotHolmes) 
2. นายชัชวาลย์ สามา รหัสนิสิต 6310406272 (ChatchawanSama)
3. นายธงไทย รุจิเวชวงษ์ รหัสนิสิต 6310403982 (timtim5569)
4. นายชานน นวจองพันธ์ รหัสนิสิต 6110403211 (MichaelTrizel)
5. นายไมเคิล แซ่เติน รหัสนิสิต 6310401122 (7842)
6. นายเมษ บัณฑิตย์ชาติ รหัสนิสต 6310406345 (mes-bunditchate)

#คำแนะนำในการติดตั้งโปรเจคสำหรับการพัฒนาด้วยคำสั่งของ docker-compose
ต้องเปิด 3 Terminal สำหรับ VueJs, Laravel, SockerIO และหากเป็นการ clone ครั้งแรกจำเป็นที่จะต้อง
รันคำสั่งเหล่านี้ก่อน
- VueJs
cd client/ && docker-compose up -d
- Laravel
1. docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
2. cp .env.example .env
3. sail up -d
4. sail artisan key:generate
5. sail artisan jwt:secret (ถ้าไม่ได้ให้ sail composer require php-open-source-saver/jwt-auth ก่อน)
6. sail artisan storage:link
7. sail artisan migrate:fresh --seed
8. sail composer require spatie/laravel-searchable
- Vuejs
9. cd /client
10. docker compose up -d
11. docker-compose exec app npm install -g npm@latest
- SocketIO
12. cd /client/server
13. docker-compose exec app npm install

# คำแนะนำในการรันโปรเจคหรือการเข้าถึงหน้าเว็บไซต์
- VueJs (ในโฟลเดอร์ client)
14. docker-compose exec app npm run dev
- SocketIO (ในโฟลเดอร์ client/server)
15. docker-compose exec app npm run start

# หมายเหตุ
- การรันในครั้งถัด ๆ ไปให้ทำข้อ 3, 9, 10, 12, 14, 15) หรือทำตามข้อด้านล่าง
- สามารถใช้ shell script "up.sh" ในการรัน server ทั้งหมดในคำสั่งเดียวได้
- และ "down.sh" ก็มีเช่นกัน
- แต่ในบางกรณี การ encode ของไฟล์ที่ถูก upload ขึ้น git มักมีปัญหา จำเป็นต้องทำ EOL Conversion ให้เป็น unix-style ก่อนจึงจะใช้ได้

# account สำหรับทดสอบระบบ
default username และ password สำหรับผู้ใช้แต่ละ role
User
Email: black_adam@hotmail.com
Password: blackadam

User
Email: user01@api.example.com
Password: userpass

Admin
Email:admin01@example.com
Password: adminpass

#Release Tag
v1.0
