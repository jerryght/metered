<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<script type="text/javascript">
    function ajax(url, method = 'GET' ){
        var xhr = new XMLHttpRequest();
        xhr.open(method, url);
        xhr.send();
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 ){
                if(xhr.status == 200){
                    console.log(xhr.responseText,xhr.responseXML,xhr.statusText);
                }else{
                    ajax(url);
                }
            }
            console.log(xhr.status);
        }
    }
    let house = '/tarding';
    ajax(house);
</script>
</body>
</html>