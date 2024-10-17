function requestTo(responseHandler,data,url)
{
    $.ajax({
        url: url,
        method: 'post',
        data: data,
        success: function(response){
            console.log(response);
            
            //Функция-обработчик ответа
            if(responseHandler!==null){
                responseHandler(response);
            }
        }
    });
}

