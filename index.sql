
CREATE DATABASE IF NOT EXISTS quan_ly_web_phim;
USE quan_ly_web_phim;


CREATE TABLE IF NOT EXISTS vai_tro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_vai_tro VARCHAR(20) NOT NULL
);


CREATE TABLE IF NOT EXISTS quoc_gia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_quoc_gia VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS the_loai (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_the_loai VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS nguoi_dung (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_dang_nhap VARCHAR(50) UNIQUE NOT NULL,
    matKhau VARCHAR(255) NOT NULL,
    ho_ten VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    sdt VARCHAR(10),
    vai_tro_id INT,
    ngay_sinh DATE,
    FOREIGN KEY (vai_tro_id) REFERENCES vai_tro(id)
);


CREATE TABLE IF NOT EXISTS dien_vien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_dien_vien VARCHAR(100) NOT NULL,
    ngay_sinh DATE,
    quoc_gia_id INT,
    FOREIGN KEY (quoc_gia_id) REFERENCES quoc_gia(id)
);


CREATE TABLE IF NOT EXISTS dao_dien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_dao_dien VARCHAR(100) NOT NULL,
    ngay_sinh DATE,
    quoc_gia_id INT,
    FOREIGN KEY (quoc_gia_id) REFERENCES quoc_gia(id)
);


CREATE TABLE IF NOT EXISTS phim (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_phim VARCHAR(255) NOT NULL,
    dao_dien_id INT,
    nam_phat_hanh INT,
    poster VARCHAR(255),
    quoc_gia_id INT,
    so_tap INT,
    trailer VARCHAR(255),
    mo_ta TEXT,
    FOREIGN KEY (dao_dien_id) REFERENCES dao_dien(id),
    FOREIGN KEY (quoc_gia_id) REFERENCES quoc_gia(id)
);


CREATE TABLE IF NOT EXISTS phim_dien_vien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    phim_id INT,
    dien_vien_id INT,
    FOREIGN KEY (phim_id) REFERENCES phim(id) ON DELETE CASCADE,
    FOREIGN KEY (dien_vien_id) REFERENCES dien_vien(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS phim_the_loai (
    id INT PRIMARY KEY AUTO_INCREMENT,
    phim_id INT,
    the_loai_id INT,
    FOREIGN KEY (phim_id) REFERENCES phim(id) ON DELETE CASCADE,
    FOREIGN KEY (the_loai_id) REFERENCES the_loai(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS tap_phim (
    id INT PRIMARY KEY AUTO_INCREMENT,
    so_tap INT NOT NULL,
    tieu_de VARCHAR(255) NOT NULL,
    phim_id INT,
    thoiLuong FLOAT,
    video_url VARCHAR(255),
    FOREIGN KEY (phim_id) REFERENCES phim(id) ON DELETE CASCADE
);

-- Chèn dữ liệu mẫu cho bảng vai_tro
INSERT INTO vai_tro (ten_vai_tro) VALUES 
('Admin'), ('User'), ('Moderator'), ('Editor'), ('Viewer');

INSERT INTO quoc_gia (ten_quoc_gia) VALUES 
('Việt Nam'), ('Mỹ'), ('Hàn Quốc'), ('Trung Quốc'), ('Nhật Bản'),
('Thái Lan'), ('Pháp'), ('Anh'), ('Đức'), ('Ý'),
('Ấn Độ'), ('Brazil'), ('Canada'), ('Úc'), ('Nga'),
('Tây Ban Nha'), ('Mexico'), ('Indonesia'), ('Malaysia'), ('Philippines'),
('Singapore'), ('Thụy Sĩ'), ('Hà Lan'), ('Thụy Điển'), ('Na Uy'),
('Đan Mạch'), ('Phần Lan'), ('Bồ Đào Nha'), ('Hy Lạp'), ('Thổ Nhĩ Kỳ');


INSERT INTO the_loai (ten_the_loai) VALUES 
('Hành động'), ('Tình cảm'), ('Hài hước'), ('Kinh dị'), ('Viễn tưởng'),
('Phiêu lưu'), ('Khoa học'), ('Thần thoại'), ('Cổ trang'), ('Hiện đại'),
('Võ thuật'), ('Âm nhạc'), ('Thể thao'), ('Trinh thám'), ('Hình sự'),
('Chiến tranh'), ('Lịch sử'), ('Tài liệu'), ('Gia đình'), ('Hoạt hình'),
('Siêu anh hùng'), ('Ma cà rồng'), ('Zombie'), ('Giả tưởng'), ('Kịch tính'),
('Bí ẩn'), ('Tâm lý'), ('Lãng mạn'), ('Học đường'), ('Y khoa');

SELECT * FROM phim p
join quoc_gia qg on p.quoc_gia_id = qg.id
where p.id = 10;

SELECT p.ten_phim, p.quoc_gia, nd.ho_ten as ten_dao_dien FROM phim p
join quoc_gia qg on p.quoc_gia_id = qg.id
join dao_dien dd on p.dao_dien_id = dd.id
join dien_vien dv on p.dien_vien_id = dv.id
where p.id = 10
group by p.id;




