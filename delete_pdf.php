<?php
	header('Content-type: application/json');

	$jms_pdf_remove =	$_POST['jms_pdf_remove'];
	// $response_array['jms_pdf_remove'] = $jms_pdf_remove;

    function jms_delete_pdf($pdf)
    {
        $path = "admin/pdf_save/".$pdf;
       	
       	if(file_exists($path))
        {
			unlink($path);
		}	
    }

    if($jms_pdf_remove != "")
	{
		jms_delete_pdf($jms_pdf_remove);
	}

	$response_array['status'] = 'success';
    echo json_encode($response_array);
?>