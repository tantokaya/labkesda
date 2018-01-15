CREATE VIEW v_kegiatan AS
SELECT
	  kegiatan_id as kode,
    kegiatan, jenis_kegiatan,
    lokasi, unit_kerja as satker,
    DATE_FORMAT(tanggal_mulai,"%d/%m/%Y") as tanggal_mulai,
    DATE_FORMAT(tanggal_akhir,"%d/%m/%Y") as tanggal_akhir,
    is_private,
    user_id,
    k.unit_kerja_id
FROM
	kegiatan k
JOIN
	jenis_kegiatan jk ON k.jenis_kegiatan_id = jk.jenis_kegiatan_id
LEFT JOIN
	unit_kerja uk ON k.unit_kerja_id = uk.unit_kerja_id