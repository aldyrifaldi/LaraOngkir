<!doctype html>
<html lang="en">
  <head>
    <title>LaraOngkir</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css' integrity='sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==' crossorigin='anonymous'/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <h1 class="text-center mt-2">Laravel Ongkir</h1>

    <div class="container">
        <form>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="">Provinsi Asal</label>
                  <select required onchange="getKotaAsal($(this))" class="form-control provinsi_asal" name="province_origin" id="">
                    <option selected disabled>Pilih Provinsi Asal</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="">Kota Asal</label>
                  <select required  class="form-control kota_asal" name="city_origin" id="">
                    <option selected disabled>Pilih Kota Asal</option>
                  </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="">Provinsi Tujuan</label>
                  <select required onchange="getKotaTujuan($(this))" class="form-control provinsi_tujuan" name="province_destination" id="">
                    <option selected disabled>Pilih Provinsi Tujuan</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="">Kota Tujuan</label>
                  <select required class="form-control kota_tujuan" name="city_destination" id="">
                    <option selected disabled>Pilih Kota Tujuan</option>
                  </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="">PIlih Kurir</label>
                  <select required class="form-control" name="courier" id="">
                    <option selected disabled>Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                  </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="">Berat Kiriman (Dalam Gram)</label>
                  <input required type="number" name="weight" id="" class="form-control" placeholder="Masukkan berat kiriman (dalam gram)" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary btn-block">Cek Sekarang</button>
            </div>
        </div>
        </form>

        <h4 class="mt-5 nama_kurir"></h4>
        <table class="mt-5 table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Service</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js' integrity='sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js' integrity='sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==' crossorigin='anonymous'></script>
    <script>
        $(document).ready(function(){
            axios({
                method: 'GET',
                url: '{{url("api/rajaongkir/province")}}',
            })
            .then((res) => {
                $.each(res.data.data,function(i,v){
                    $('.provinsi_asal').append(`
                            <option value="${v.province_id}">${v.province}</option>
                    `)
                    $('.provinsi_tujuan').append(`
                            <option value="${v.province_id}">${v.province}</option>
                    `)
                })
            })
        })

        function getKotaAsal(element) {
            $('.kota_asal').html('')
            let provinsi_id = element.val()
            axios({
                method: 'GET',
                url: '{{url("api/rajaongkir/city")}}?province_id='+provinsi_id,
            })
            .then((res) => {
                console.log(res.data);
                $.each(res.data.data,function(i,v){
                    $('.kota_asal').append(`
                        <option value="${v.city_id}">${v.city_name}</option>
                    `)
                })
            })
        }

        function getKotaTujuan(element) {
            $('.kota_tujuan').html('')

            let provinsi_id = element.val()
            axios({
                method: 'GET',
                url: '{{url("api/rajaongkir/city")}}?province_id='+provinsi_id,
            })
            .then((res) => {
                $.each(res.data.data,function(i,v){
                    $('.kota_tujuan').append(`
                        <option value="${v.city_id}">${v.city_name}</option>
                    `)
                })
            })
        }

        $('form').submit(function(e){
            $('tbody').html('')

            e.preventDefault();
            let data = new FormData($(this)[0])
            axios({
                method: 'POST',
                url: '{{url("api/rajaongkir/cost")}}',
                data: data
            })
            .then((res) => {
                $('h4.nama_kurir').text('Kurir : '+res.data.data[0].name)
                if (res.data.data[0].costs.length > 0) {
                    $.each(res.data.data[0].costs,function(index,value){
                        console.log(value);
                        $('tbody').append(`
                            <tr>
                                <td scope="row">${index + 1}</td>
                                <td>${value.service}</td>
                                <td>${value.description}</td>
                                <td>${value.cost[0].value}</td>
                            </tr>
                        `)
                    })
                }
                else {
                    $('tbody').html(`
                        <tr>
                            <td colspan="5" class="text-center text-muted" scope="row">Service Tidak Tersedia</td>
                        </tr>
                    `)
                }
            })
            .catch((err) => {
                alert(err)
            })
        })

    </script>
  </body>
</html>
