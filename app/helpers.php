<?php

function get_bulan($month)
{
	if ($month < 1 || $month > 12)
	{
		throw new Exception("Month must be between 1-12", 1);
	}

	$bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

	return $bulan[$month];
}