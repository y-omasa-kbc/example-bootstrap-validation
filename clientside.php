<!-- Bootstrapのバリデーションチェック機能を利用したクライアントサイドでのチェック例 -->
<!-- 注意：このコードでは一度不正な書式のエラーを出現させた後で値を消すと、表示が不正 -->
<!-- な書式のエラーのままになる。 -->
<!doctype html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>クライアントサイドバリデーションチェックの例</title>
</head>
<body>
    <div class="container">
        <form action="clientside_result.php" method="POST" class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validation05">郵便番号</label>
                    <input type="text" name="postalCode" class="form-control" id="validation05" placeholder="郵便番号を入力"
                        required oninput="checkPostalCode()">
                    <div id="postalCodeInvalidMsg" class="invalid-feedback">
                        郵便番号を入力してください
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">送信する</button>
        </form>
    </div>

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

    <script>
    function checkPostalCode() {
        //独自条件の追加 郵便番号の書式チェック
        //正規表現パターン（000-0000）
        var regex = new RegExp(/^[0-9]{3}-[0-9]{4}$/);
        //郵便番号を入力しているinput要素を取得
        inputPostal = document.getElementById('validation05');
        //もし入力データが正規表現と会わない場合
        if (!regex.test(inputPostal.value)) {
            inputPostal.setCustomValidity('不正な書式');
            document.getElementById('postalCodeInvalidMsg').innerHTML = '郵便番号の書式が正しくありません';
        } else {
            inputPostal.setCustomValidity('');
        }
    }

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Bootstrapのフォームの入力検証スタイルを適用するフォームを取得
            var forms = document.getElementsByClassName('needs-validation');
            // ループして帰順を防ぐ
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) { //submitイベントを捕まえる
                    if (form.checkValidity() === false) { //バリデーションチェックに失敗
                        event.preventDefault(); //標準動作のキャンセル
                        event.stopPropagation(); //イベント伝播を停止
                    } 
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>


</body>

</html>