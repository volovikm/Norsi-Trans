function collectFormData(form) //Функция для сбора данных с формы
{
    var form_data=[];

    //Сбор со всех input
    let inputs = form.querySelectorAll('input');
    for (let i = 0; i < inputs.length; i++) 
    {form_data[inputs[i].getAttribute('field_id')]=inputs[i].value;}

    let selects = form.querySelectorAll('select');
    for (let i = 0; i < selects.length; i++) 
    {form_data[selects[i].getAttribute('field_id')]=selects[i].value;}

    return(form_data);
}

//Обработчик формы добавления компонента
function assemblyItemFormHandler()
{
    let form=document.getElementById("assembly_item_modal");
    if(form==null) return(false);

    let save_assembly_item=document.getElementById("save_assembly_item");

    save_assembly_item.addEventListener('click',function(event){
        var form_data=collectFormData(form);

        var data = {
            count: form_data['count'],
            assembly_id: form_data['assembly_id'],
            item_id: form_data['item_id']
        };

        url='index.php?r=assembly_item%2Fcreate';
        requestTo(responseHandler,data,url);
    });

    
}
assemblyItemFormHandler();

//Обработчик ответа сервера
function responseHandler(response)
{
    let error_message=document.getElementById("error_message");
    let close_modal_button=document.getElementById("close_modal_button");

    if(response=="request_error")
    {
        error_message.innerHTML="Ошибка запроса";
        return(false);
    }

    if(response=="save_complete")
    {
        close_modal_button.click();
        location.reload();
    }
}