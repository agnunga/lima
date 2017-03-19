var text = '{"name": "oloo", "posta": "kandiege"}';
var data_obj = JSON.parse(text);
document.getElementById('djsondata').innerHTML =
        data_obj.name + "<br/>" +
        data_obj.posta + "<br/>";