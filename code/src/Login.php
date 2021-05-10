<html>

<head>
</head>

<body>
    <form>
        <input type="submit" id="login">
    </form>
    <?php

    use Araditama\AuthSIAM\AuthSIAM;

    $login['nim'] = '175150600111010';
    $login['password'] = 'kegantengan';
    echo AuthSIAM::auth($login);
    ?>
</body>

</html>