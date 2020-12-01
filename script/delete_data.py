for sekolah in sekolahs:
    if sekolah['jumlah'] > 200:
        print('sekolah_id: ', sekolah['sekolah_id'])        
        print('jumlah: ', sekolah['jumlah'])
        jumlah = sekolah['jumlah'] - 200
        sql = "select * from user where level='siswa' and sekolah_id='%s' order by id LIMIT %d" %(sekolah['sekolah_id'], jumlah)
        cur_thread.execute(sql)
        siswas = cur_thread.fetchall()
        for siswa in siswas:
            print('siswa_id:' siswa['id'])
            sql = "delete from ujian_siswa where user_id="+str(siswa['id'])
            cur_thread.execute(sql)
        sql = "delete from user where level='siswa' and sekolah_id='%s' order by id LIMIT %d" %(sekolah['sekolah_id'], jumlah)
        cur_thread.execute(sql)
        db_thread.commit()
        print("ok")