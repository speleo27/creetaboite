SELECT * FROM upload INNER JOIN associates ON associates.societe_ref_prosp = upload.societe_ref_prosp WHERE upload.societe_ref_prosp= 'p002' group BY upload.upload_id;
