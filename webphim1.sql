CREATE DATABASE IF NOT EXISTS quan_li_web_phim;
nguoi dung
 id int 
 taiKhoan INT
 tenNguoiDung varchar(50)
 matKhau varchar(50)
 mã người dùng int PRIMARY KEY
 mã thể loại int FOREIGN KEY
 năm phát hành date
phim
 tenPhim varchar
 id int PRIMARY KEY
 maPhim varchar
thể loại
 id int PRIMARY KEY
 tên thể loại varchar(50)
số tập
 maTap int PRIMARY KEY
quốc gia
 tenQuocGia varchar
 maQuocGia int PRIMARY KEY
