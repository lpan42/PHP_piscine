var ft_list = $("#ft_list");

$(document).ready(function(){
    function add_todo(id, text){
        var newtd = document.createElement("div");
        newtd.id = id;
        newtd.innerHTML = text;
        ft_list.prepend(newtd);
        newtd.onclick = function(){del_todo(id);};
    }
    
    function del_todo(id){
        if (confirm("Remove this item?"))
        {
            $.ajax(`delete.php?id=${id}`,{
               type :  "GET",
               success: function(res) {
                ft_list.empty();
                for (var id in res) {
                    add_Todo(id, res[id]);
                }
            }
            });
        }
    }

	$.ajax(`select.php`,{
        type: "GET",
		success: function(res) {
            for (var id in res)
                add_todo(id, res[id]);
		}
	})

	$("#btn").click(function() {
		var text = prompt("Create a ToDo");
		if (text){
            $.ajax(`insert.php?value=${text}`, {
                type: "GET",
                success: function(res) {
                    add_todo(res[id], text);
                }
            });
        }
	});
});