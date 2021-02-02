## Prerequisite
- RajaOngkir account, if you doesn't have you can create in https://rajaongkir.com/akun/daftar 
## Installation

Via Terminal (linux)
`git clone https://github.com/aldyrifaldi/LaraOngkir.git`

Or Download from github
https://github.com/aldyrifaldi/LaraOngkir

## Configuration
- Create `.env` file and copy that content from `.env.example`
-  In .env file set variable `RAJA_ONGKIR_API_KEY=` pass your api key from RajaOngkir account link https://rajaongkir.com/akun/panel
- and set variable `RAJA_ONGKIR_URL_API=`	pass your url api from raja ongkir link https://rajaongkir.com/dokumentasi in **Account Type** section.
- Composer install

## Usage
- run `php artisan migrate`
- and open in browser `http://localhost:8000` default
- enjoy
