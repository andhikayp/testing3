-- cari data sekolah yg tidak ada siswanya 
select * from sekolah u where u.id not in (select distinct sekolah_id from user us where us.'level' = 'siswa')
-- hapus data sekolah yg tidak ada siswanya
delete from sekolah where id not in (select distinct sekolah_id from user us where us.'level' = 'siswa')

-- cari data user yg tidak ada ujiannya 
select * from user u where u.'level' ='siswa' and u.id not in (select distinct us.user_id from ujian_siswa us);
delete from user where 'level' ='siswa' and id not in (select distinct us.user_id from ujian_siswa us);
	
select count(*) from ujian_siswa us where us.user_id in (
select id from user u where u.sekolah_id ='d38b695a-41b4-11ea-a9ba-dc7196bc523b');

-- cari jumlah siswa bahasa yg memakai kurikulum 2013
SELECT count(*) as jumlah, u.sekolah_id from 'user' u join sekolah s on u.sekolah_id = s.id WHERE s.kurikulum = '2013' 
and u.jurusan = 'bahasa' and u.'level' = 'siswa' group by u.sekolah_id order by jumlah desc;



