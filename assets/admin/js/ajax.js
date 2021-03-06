// Append modal as direct child of body
$('#modal-preloader').appendTo('body');



/*Data Table Option*/
function dataTable() {
    $(".table1").DataTable();
    $('.table2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false
    });

    $("#table1").DataTable();
    $('#table2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false
    });
};

/*Handle tooltip hide when click*/  
$(document).on('click', function () {
    $(this).find('.tooltip').tooltip('hide');
});


/*Handle Cookies*/
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/*Sidebar Click handle*/
$('.sidebar-menu > li').click(function(event) {
	$('.sidebar-menu > li').removeClass('active');
	$(this).addClass('active');
	$('.content-header h1').html($(this).find('a').text());
	if(parseInt($('body').css('width'))<768) $('a.sidebar-toggle').click();
});


$('#sidebar-dashboard').click(function(event) {
	setCookie("sidebar", "dashboard", 0.5);
	$('#main-content').html('');
	$('#preloader').css('display','block');
	$.get(base_url+"Admin/Dashboard", function(data) {
		$('#preloader').css('display','none');
		$('#main-content').html(data);
		
	});
});

$('#sidebar-lokasi').click(function(event) {
	$('#main-content').html('');
	$('#preloader').css('display','block');
	$.get(base_url+"Admin/Lokasi", function(data) {
		$('#preloader').css('display','none');
		$('#main-content').html(data);
		setCookie("sidebar", "lokasi", 0.5);
		dataTable();
	});
});


$('#sidebar-history').click(function(event) {
	$('#main-content').html('');
	$('#preloader').css('display','block');
	$.get(base_url+"Admin/History", function(data) {
		$('#preloader').css('display','none');
		$('#main-content').html(data);
		setCookie("sidebar", "history", 0.5);
		dataTable();
	});
});

$('#sidebar-perbaikan').click(function(event) {
	$('#main-content').html('');
	$('#preloader').css('display','block');
	$.get(base_url+"Admin/Perbaikan", function(data) {
		$('#preloader').css('display','none');
		$('#main-content').html(data);
		setCookie("sidebar", "perbaikan", 0.5);
		dataTable();
	});
});


