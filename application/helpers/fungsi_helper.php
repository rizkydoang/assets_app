<?php

function cek_login()
{
	$ci = get_instance();
	if (!$ci->session->has_userdata('login_session')) {
		// set_pesan('Silahkan login.', false);
		redirect('auth');
	}
}

function is_controller()
{
	$ci = get_instance();
	$role = $ci->session->userdata('login_session')['divisi'];

	$status = false;

	if ($role == 1) {
		$status = true;
	}

	return $status;
}

function is_controller_and_direct()
{
	$ci = get_instance();
	$role = $ci->session->userdata('login_session')['divisi'];

	$status = false;

	if ($role == 1 or $role == 2 or $role == 3 or $role == 4 or $role == 5) {
		$status = true;
	}

	return $status;
}

function set_pesan($pesan, $tipe = true)
{
	$ci = get_instance();
	if ($tipe) {
		$ci->session->set_flashdata('pesan', "<div class='alert alert-success'><strong>SUCCESS!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	} else {
		$ci->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	}
}

function replaceFormat($rupiah)
{
	return preg_replace("/\./", "", $rupiah);
}

function formatRupiah($numeric)
{
	return number_format($numeric, 0, '', '.');
}
