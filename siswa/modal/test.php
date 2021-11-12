<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/alert/iziToast.min.css">
    <title>Document</title>
</head>

<body>
    <h1>Ijeasjkldfhasdhf</h1>

</body>
<script type="text/javascript" src="../../assets/alert/iziToast.min.js"></script>

<script>
    alert("Oke");
    alert("uhehgehegheghegf");
    iziToast.show({
        title: 'Hey',
        message: 'What would you like to add?'
    })
    iziToast.success({
        title: 'Selamat',
        message: 'Anda berhasil login sebagai mentor, sebentar ya...',
        position: 'topRight'
    });
    setTimeout(function() {
        window.location.href = "";
    }, 3000);
</script>

</html>