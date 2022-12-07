<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <title>Lab8</title>
</head>
<body>

<div class="container">
    <h3>IP search</h3>
    <input type="text" name="ip" id="ip-input" placeholder="IP" title="Enter IP address"/>
    <input type="submit" value="IP search" id="submit"/>
    <span id="validation-msg">[Invalid IP]</span>
    <br/>
    <div id="result">
        <br><span>Details for </span>
        <span id="ip"></span><br><br>
        <p><strong>Geolocation Info</strong></p>
        <span>Country code: </span>
        <span id="county-code"></span><br>
        <span>Flag:
                <img id="flag" src="" alt=""/>
            </span><br>
        <span>Region: </span>
        <span id="region"></span><br>
        <span>Region Name: </span>
        <span id="region-name"></span><br>
        <span>City: </span>
        <span id="city"></span><br>
        <span>Postal Code: </span>
        <span id="zip"></span><br>
        <span>Latitude: </span>
        <span id="latitude"></span><br>
        <span>Longitude: </span>
        <span id="longitude"></span><br>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    const ipInput = document.getElementById('ip-input');

    function onError(err) {
        console.error(err);
        $('#validation-msg').text(`[${err.reason || 'Ajax error'}]`);
        $('#validation-msg').css('color', (err.reason === 'Reserved IP') ? 'green' : 'red');
        $('#validation-msg').show();
        $('#result').css('display', 'block');
        $('#flag').attr('src', `./flags_ISO/_unitednations.png`);
        $('#county-code').text('N/A');
        $('#region').text('N/A');
        $('#region-name').text('N/A');
        $('#city').text('N/A');
        $('#zip').text('N/A');
        $('#latitude').text('N/A');
        $('#longitude').text('N/A');
    }

    ipInput.addEventListener('keypress', function (e) {
        ipInput.value = ipInput.value.replace(/\s/g, '');
        if (ipInput.value.indexOf('.') !== -1 && /[^0-9.]/g.test(ipInput.value)) {
            ipInput.value = ipInput.value.replace(/[^0-9.]/g, '');
        }
        ipInput.value = ipInput.value.replace(/^\.{1}/, '');
        ipInput.value = ipInput.value.replace(/\.{2,}/g, '.');
        if (ipInput.value.split('.').length > 4 && ipInput.value.lastIndexOf('.') === ipInput.value.length - 1) {
            ipInput.value = ipInput.value.substr(0, ipInput.value.length - 1);
        }
        if (ipInput.value.length === 0 || /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/.test(ipInput.value)) {
            $('#validation-msg').hide();
        } else {
            $('#validation-msg').show();
        }
    });

    $('#submit').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: `https://ipapi.co/${ipInput.value}/json/`,
            type: 'GET',
            dataType: 'json',
            crossDomain: true,
            success: function (res) {
                if (res.error) {
                    onError(res);
                    return;
                }
                $('#validation-msg').css('display', 'none');
                $('#result').css('display', 'block');
                $('#ip').text(res.ip);
                $('#flag').attr('src', `./flags_ISO/${res.country_code.toLowerCase()}.png`);
                $('#county-code').text(res.country_code);
                $('#region').text(res.region_code);
                $('#region-name').text(res.region);
                $('#city').text(res.city);
                $('#zip').text(res.postal);
                $('#latitude').text(res.latitude);
                $('#longitude').text(res.longitude);
            },
            error: onError
        });
    });
</script>

<script src="/js/bootstrap.min.js"></script>
</body>
</html>
