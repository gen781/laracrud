# laracrud
Basic CRUD application based on laravel for web service & Nativescript-vue for mobile application

## Install
Clone repository :
```bash
git clone https://github.com/gen781/laracrud.git
```

### Web Service
Enter to web directory :
```bash
cd laracrud/web
```
Use composer for installation:
```bash
composer install
```
Make MySQL database "laracrud" for the name & then migrate + seeds the data to database :
```bash
php artisan migrate --seed
```
Run the server:
```bash
php artisan serve
```
Open the browser & type to the url address bar:
```url
http://localhost:8000
```

### Mobile Application
Enter to mobile directory :
```bash
cd laracrud/mobile
```
Use npm for installation:
```bash
npm install
```
Preview apps via Nativescript Playground:
```bash
tns preview
```
Then scan the barcode through your Nativescript Playground. If you don't have, please download it first on Playstore.

## License
[MIT](https://choosealicense.com/licenses/mit/)

