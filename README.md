#แนะนำโปรเจคสั้นๆ
    
#สมาชิกกลุ่ม CT
1. นายซาฮิล ชูดวง รหัสนิสิต 6310406281 (NotHolmes) 
2. นายชัชวาลย์ สามา รหัสนิสิต 6310406272 (ChatchawanSama)
3. นายธงไทย รุจิเวชวงษ์ รหัสนิสิต 6310403982 (timtim5569)
4. นายชานน นวจองพันธ์ รหัสนิสิต 6110403211 (MichaelTrizel)
5. นายไมเคิล แซ่เติน รหัสนิสิต 6310401122 (7842)
6. นายเมษ บัณฑิตย์ชาติ รหัสนิสต 6310406345 (mes-bunditchate)

#คำแนะนำในการติดตั้งโปรเจคสำหรับการพัฒนาด้วยคำสั่งของ docker-compose
ต้องเปิด 3 Terminalสำหรับ VueJs, Laravel, SockerIO
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
3. sail artisan jwt:secret (ถ้าไม่ได้ให้ sail composer require php-open-source-saver/jwt-auth ก่อน)
- SocketIO
1. cd /client/server
2. docker compose up -d

#คำแนะนำในการติดตั้งโปรเจคสำหรับ deploy
- VueJs
docker-compose exec app npm install -g npm@latest
- Laravel
ไม่ต้องทำอะไร
- SocketIO
docker-compose exec app npm install

#คำแนะนำในการรันโปรเจคหรือการเข้าถึงหน้าเว็บไซต์
- VueJs
docker-compose exec app npm run dev
- Laravel
ไม่ต้อง run อะไร
- SocketIO
docker-compose exec app npm run start

#default username และ password สำหรับผู้ใช้แต่ละ role
User
Email: black_adam@hotmail.com
Password: blackadam
Admin
Email:admin01@example.com
Password: adminpass

#Release Tag Before Present
v1.0

