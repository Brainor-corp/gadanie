$(document).ready(function () {
    $(document).on('click', '#add-element-btn', function (e) {
        e.preventDefault();
        var btn = $(this);
        var lastId = $( '.element' ).filter( ':last' ).data('elementId');
        var newId = lastId + 1;
        $.ajax({
            type: 'post',
            url: '/wp-content/plugins/brainor-gadanie/includes/admin/element_get.php',
            cache: false,
            dataType:"json",
            beforeSend: function() {
                // document.getElementById('ajax-loading-gif').style.display = 'block';
            },
            success: function(data){
                var html =
                    '<div class="element" id="element_'+newId+'" data-element-id="'+newId+'"  style="border: 1px #cccccc dashed; padding: 15px; margin-bottom: 15px">'+
                    '<div class="row">'+
                    '<div class="col-6">'+
                    '<div class="form-group">'+
                    '<label for="thumb">Связанный элемент</label>'+
                    '<select class="form-control" id="elements['+newId+'][id]" name="elements['+newId+'][id]">';
                html = html +'<option selected disabled value="">Выберите пункт</option>';
                for(var i=0;i<data.length;i++)
                {
                    html = html +'<option value="'+data[i].id+'"> '+data[i].name+'</option>';
                }
                html = html +
                    '</select>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-6">'+
                    '<div class="form-group">'+
                    '<label for="thumb">Миниатюра</label>'+
                    '<input type="text" class="form-control" id="thumb" name="elements['+newId+'][thumb]" placeholder="Миниатюра">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="row">'+
                    '<div class="col-12">'+
                    '<div class="form-group">'+
                    '<label for="description">Описание</label>'+
                    '<textarea class="form-control" id="description" name="elements['+newId+'][description]" rows="5" placeholder="Введите описание"></textarea>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<button class="btn btn-danger del-element-btn" data-element-id="'+newId+'">Удалить элемент</button>'+
                    '<br>';
                btn.before(html);
            },
            error:function(error){
                console.log(error);
            }
        });
    });

    $(document).on('click', '#add-element-by-group-btn', function (e) {
        e.preventDefault();
        var data = $('#add-element-by-group-form').serialize();
        console.log(data);
        $.ajax({
            type: 'post',
            url: '/wp-content/plugins/brainor-gadanie/includes/admin/get_element_by_group.php',
            data: data,
            cache: false,
            beforeSend: function() {
                // document.getElementById('ajax-loading-gif').style.display = 'block';
            },
            success: function(html){
                $('#add-element-btn').before(html);
            },
            error:function(error){
                console.log(error);
            }
        });
    });

    $(document).on('click', '.del-element-btn', function (e) {
        e.preventDefault();
        var id=$(this).data("elementId");
        document.getElementById("element_"+id).remove()
    });
});