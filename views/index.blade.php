
<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
    <li class="nav-item">
        <a class="nav-link active" id="tab1_li" onclick="listClients()" href="#listClients" data-toggle="tab">
        <i class="fas fa-download mr-2"></i>
        {{__('Clients')}}</a>
    </li>

    
</ul>

<div class="tab-content">
    <div id="listClients" class="tab-pane active">
    <div class="table-responsive" id="listClients"></div>

    </div>
    
</div>


@component('modal-component',[
                "id" => "idid"
            ])
            <div id="tablo" class="table-content">
                <div class="table-body"> </div>
            </div>
@endcomponent

<script>

    if(location.hash === ""){
        listClients();
    }
    function listClients(){
                    showSwal('{{__("Yükleniyor...")}}','info');
                    var form = new FormData();
                    request(API('list_clients'), form, function(response) {
                        $('#listClients').html(response).find('table').DataTable(dataTablePresets('normal'));
                        Swal.close();
                    }, function(response) {
                        let error = JSON.parse(response);
                        Swal.close();
                        showSwal(error.message, 'error', 3000);
                    });
                }
            function list10(line){
                
                var form = new FormData();
                let name = line.querySelector("#name").innerHTML;
                form.append("name",name);
                request(API('list_10'), form, function(response) {
                    message = JSON.parse(response)["message"];
                    $('#tablo').find('.table-body').html(message).find("table").DataTable(dataTablePresets('normal'));
                        $('#idid').find('.modal-header').html('<h4>'+'syslog ilk 10 satır'+'</h4>');
                        $('#idid').modal("show");
                }, function(error) {
                        showSwal(error.message, 'error', 5000);
                   });
            }
            function listAll(line){
                
                var form = new FormData();
                let name = line.querySelector("#name").innerHTML;
                form.append("name",name);
                request(API('list_all'), form, function(response) {
                    message = JSON.parse(response)["message"];
                    $('#tablo').find('.table-body').html(message).find("table").DataTable(dataTablePresets('normal'));
                        $('#idid').find('.modal-header').html('<h4>'+'satır sayıları'+'</h4>');
                        $('#idid').modal("show");
                }, function(error) {
                        showSwal(error.message, 'error', 5000);
                   });
            }
    
</script>