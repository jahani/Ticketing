# Project Features

## App Specific
- Models filter

## Laravel Used Features
- Translatable strings => Subdomain localization (multilingual with rtl support)
- Configuration parameters
- Migration
- Storage
- Session
- Command => Cleanup old reservations/orders
- Schedule
- Policy => AdminAlwaysCanPolicy trait
- Request
- Resource
- Middleware => auth.admin, keep logged out banned users
- Factory (using faker)
- Table Seed
- Pagination
- Blade directives
- View composer

## Laravel Tools
- Tinker

## Laravel Packages
- barryvdh/laravel-translation-manager
- bensampo/laravel-enum
- caouecs/laravel-lang
- cybercog/laravel-ban
- netojose/laravel-bootstrap-4-forms
- barryvdh/laravel-debugbar

## NodeJS Packages
- axios
- browser-sync
- jquery
- vue
- bootstrap
- bootstrap-v4-rtl
- bootswatch => darkly theme
- font-awesome
- jquery-countdown
- moment-jalaali
- nprogress (Slim progress bar)
- tempusdominus-bootstrap-4 (Datetime Picker)
- vue-persian-datetime-picker
- vue-visible
- samim-font


# Notepad

### Similar Sites:
* https://www.eventbrite.com/create/seat-map?eid=52637682726&seatmap_eid=None
* https://www.exirconcert.com

### TODOs:
- Need ajax and level by level load: http://localhost:8000/shows/4 ; Group Sections
- When a user login or register, Submit all session reserves for him
- What if seat is in unpayed orders and user decide to unreserve it, Bug in UI or anything else?
- Ask for user data when creating orders; Autofill them by current logged user if any

### You May Need to Use:
- https://github.com/spatie/laravel-permission
- https://github.com/netojose/laravel-bootstrap-4-forms
- https://github.com/caouecs/Laravel-lang
- https://talkhabi.github.io/vue-persian-datetime-picker/
- https://packagist.org/packages/laravelcollective/html
- https://bootstrap-vue.js.org
- https://github.com/mcamara/laravel-localization
- https://github.com/LaurentEsc/Laravel-Subdomain-Localization

### Payments:
- https://github.com/larabook/gateway
- https://chasboon.ir/%D8%AF%D8%B1%DA%AF%D8%A7%D9%87-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%D9%84%D8%A7%D8%B1%D8%A7%D9%88%D9%84
- https://github.com/artisaninweb/laravel-soap
- https://www.roxo.ir/how-to-integrate-zarinpal-payment-gateway-in-laravel/

### Admin:
- https://github.com/the-control-group/voyager
- https://github.com/laravel/telescope
- https://github.com/crocodic-studio/crudbooster

### Debug:
- https://github.com/barryvdh/laravel-debugbar
- can a user edit an event or add show for it? only logged or should have appropriate access;

### Production:
1. Ask user to verify his email.
2. Auth::routes([ 'verify' => true ]);
3. $user->verified?

### Check later:
- https://github.com/andrey-helldar/laravel-lang-publisher
