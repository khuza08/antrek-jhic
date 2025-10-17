import { Link } from 'react-router-dom'

export default function NotFound() {
  return (
    <div className="flex items-center justify-center min-h-screen bg-gray-900 p-6 text-center">
      <div>
        <h1 className="text-6xl font-bold mb-4 text-white">404</h1>
        <p className="text-gray-300">Halaman tidak ditemukan.</p>
        <Link to="/" className="text-blue-400 underline hover:text-blue-300 transition">Kembali ke Beranda</Link>
      </div>
    </div>
  )
}