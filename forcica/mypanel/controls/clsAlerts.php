<?php
function ShowAlerts()
{
	if(isset($_SESSION['ErrorMessage']))
	{
		if($_SESSION['ErrorMessage']!="")
		{
			showError($_SESSION['ErrorMessage']);
			$_SESSION['ErrorMessage']='';
		}
		
	}
	
	if(isset($_SESSION['SuccessMessage']))
	{
		if($_SESSION['SuccessMessage']!="")
		{
			showSuccess($_SESSION['SuccessMessage']);
			$_SESSION['SuccessMessage']='';
		}
		
	}
	
	if(isset($_SESSION['InfoMessage']))
	{
		if($_SESSION['InfoMessage']!="")
		{
			showInfo($_SESSION['InfoMessage']);
			$_SESSION['InfoMessage']='';
		}
		
	}
}	

function showError($message)
{
	echo '<div class="alert alert-block alert-danger">';
		echo '<button type="button" class="close" data-dismiss="alert">';
			echo 'X';
		echo '</button>';
		echo $message;
	echo '</div>';
}

function showSuccess($message)
{
	echo '<div class="alert alert-block alert-success">';
		echo '<button type="button" class="close" data-dismiss="alert">';
			echo 'X';
		echo '</button>';
		echo $message;
	echo '</div>';
}

function showInfo($message)
{
	echo '<div class="alert alert-block alert-Info">';
		echo '<button type="button" class="close" data-dismiss="alert">';
			echo '<i class="icon-remove"></i>';
		echo '</button>';
		echo $message;
	echo '</div>';
}
?>