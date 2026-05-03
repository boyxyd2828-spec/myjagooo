# Dashboard Pinjaman - Vercel Ready

Proyek ini sudah siap deploy ke Vercel sebagai static site.

## Isi file

- `index.html` - file utama aplikasi
- `vercel.json` - konfigurasi Vercel
- `README.md` - panduan deploy

## Cara deploy via Vercel Dashboard

1. Extract file ZIP ini.
2. Upload folder ke GitHub.
3. Masuk ke https://vercel.com/new.
4. Import repository.
5. Framework Preset: Other.
6. Build Command: kosongkan.
7. Output Directory: kosongkan.
8. Klik Deploy.

## Cara deploy via Vercel CLI

```bash
npm i -g vercel
vercel login
vercel --prod
```

Jalankan perintah dari dalam folder proyek ini.

## Catatan

Aplikasi ini menggunakan CDN Tailwind dan face-api.js, jadi koneksi internet diperlukan saat aplikasi dibuka.
Fitur kamera membutuhkan HTTPS. Vercel sudah menyediakan HTTPS secara default.
