<!-- Bootstrapのバリデーションチェック機能を利用したサーバーサイドでのチェック例 -->

<?php
session_start();
$validity = array('familyName'=>'', 'givenName'=>'');
$_SESSION['familyName']='';
$_SESSION['givenName']='';

//リクエストメソッドがPOST、つまり"送信する"ボタンのクリックでアクセスされた。
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    //このサンプルはデータの入力だけをチェックしている。
    // is-validにする条件を変更することで必要な確認を行うこと
    if( empty($_POST['familyName']) ){                  //POSTデータにfamilyNameがない(/空)。
        $validity['familyName'] = "is-invalid";         //BootstrapのCSSクラスis-invalidを追加
    } else {
        $validity['familyName'] = "is-valid";           //BootstrapのCSSクラスis-invalidを追加
        $_SESSION['familyName']=$_POST['familyName'];   //値をセッションに保存
    }
    if( empty($_POST['givenName']) ){                   //POSTデータにfamilyNameがない(/空)。
        $validity['givenName'] = "is-invalid";          //BootstrapのCSSクラスis-invalidを追加 
    } else {
        $validity['givenName'] = "is-valid";            //BootstrapのCSSクラスis-invalidを追加
        $_SESSION['givenName']=$_POST['givenName'];     //値をセッションに保存
    }

    //問題がなければ画面を遷移 （フォームデータはすでに$_SESSIONに入っている）
    if( !array_search("is-invalid", $validity) ){   //$validityにinvalidが一件もない
        header('Location: serverside_result.php');  //結果ページにリダイレクト
    }
}
?>
<!doctype html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>サーバーサイドバリデーションチェックの例</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationServer01">姓</label>
                        <input type="text" name="familyName" class="form-control <?php echo $validity['familyName']; ?>"
                            id="validationServer01" placeholder="姓を入力" value="<?php echo $_SESSION['familyName']; ?>">
                        <div class="invalid-feedback">
                            姓を入力してください
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationServer02">名</label>
                        <input type="text" name="givenName" class="form-control <?php echo $validity['givenName']; ?>"
                            id="validationServer02" placeholder="名を入力" value="<?php echo $_SESSION['givenName']; ?>">
                        <div class="invalid-feedback">
                            名を入力してください
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">送信する</button>
        </form>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
</body>

</html>