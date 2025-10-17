import { Link } from 'react-router-dom'

export default function NotFound() {
  return (
    <div className="relative flex flex-col items-center justify-center min-h-screen bg-white dark:bg-gray-900 p-6 text-center">
      {/* Angka 404 dengan gradient warna */}
      <h1 className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-[12rem] font-bold bg-gradient-to-b from-gray-100 to-gray-300 dark:from-gray-900 dark:to-white text-transparent bg-clip-text opacity-20 dark:opacity-10 pointer-events-none z-0">
        404
      </h1>

      {/* Konten teks di atas (foreground) */}
      <div className="max-w-md relative z-10">
        <h2 className="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">
          Kamu kemana kak? <span className="font-bold">salah alamat kali</span>
        </h2>
        <p className="text-gray-600 dark:text-gray-400 mb-4">
        Sepertinya kamu salah jalan. Tapi jangan khawatir, bahkan yang terbaik pun terkadang tersesat!
        </p>
        <Link to="/" className="text-blue-600 dark:text-blue-400 transition">
          Balik ke halaman utama
        </Link>
      </div>
    </div>
  )
}