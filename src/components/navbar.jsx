import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { FaUser } from 'react-icons/fa';
import logoImage from '../assets/images/logo_embed.png';

export default function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  
  useEffect(() => {
    document.body.style.overflow = menuOpen ? 'hidden' : 'auto';
    return () => { document.body.style.overflow = 'auto'; };
  }, [menuOpen]);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 30);
    };

    window.addEventListener('scroll', handleScroll);

    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <>
      {/* dim overlay */}
      {menuOpen && (
        <div
          className="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-lg z-40 md:hidden"
          onClick={() => setMenuOpen(false)}
        />
      )}

      <header
        className={`fixed top-0 left-0 right-0 border-b border-blue-200 dark:border-white/25 text-gray-900 dark:text-white z-50 transition-colors duration-300 ${
          scrolled
            ? 'bg-gradient-to-r from-blue-50/70 to-indigo-50/70 dark:from-gray-900/70 dark:to-gray-800/70 backdrop-blur-lg'
            : 'bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800'
        }`}
      >
        <div className="max-w-7xl mx-auto flex items-center justify-between py-4 px-6">
          
        {/* Logo */}
        <Link to="/" className="flex items-center">
          <img
            src={logoImage}
            alt="SMK Antartika 2 Sidoarjo"
            className="h-10 md:h-11 w-auto object-contain"
          />
        </Link>

          {/* mobile menu btn */}
          <div className="md:hidden">
            <button
              onClick={() => setMenuOpen(!menuOpen)}
              className="focus:outline-none text-blue-700 dark:text-blue-400"
            >
              <svg
                className="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                {menuOpen ? (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                ) : (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                )}
              </svg>
            </button>
          </div>

          {/* desktop nav */}
          <nav className="hidden md:flex space-x-8 items-center">
            <Link to="/" className="hover:text-blue-600 dark:hover:text-blue-300 transition">Beranda</Link>
            <Link to="/tentang" className="hover:text-blue-600 dark:hover:text-blue-300 transition">Tentang</Link>
            <Link to="/guru" className="hover:text-blue-600 dark:hover:text-blue-300 transition">Guru</Link>
            <Link to="/achievements" className="hover:text-blue-600 dark:hover:text-blue-300 transition">Prestasi</Link>
            <Link to="/gallery" className="hover:text-blue-600 dark:hover:text-blue-300 transition">Galeri</Link>
            <Link
              to="/contact"
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition"
            >
              Hubungi
            </Link>

          </nav>
        </div>

        {/* mobile menu */}
        <div
          className={`md:hidden ${menuOpen ? 'block' : 'hidden'} bg-gradient-to-b from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur-lg pb-4 relative z-50`}
        >
          <div className="flex flex-col space-y-4 px-6 py-2 text-gray-900 dark:text-white">
            {[
              { to: '/', text: 'Beranda' },
              { to: '/tentang', text: 'Tentang' },
              { to: '/guru', text: 'Guru' },
              { to: '/achievements', text: 'Prestasi' },
              { to: '/gallery', text: 'Galeri' }
            ].map((item, idx) => (
              <Link
                key={idx}
                to={item.to}
                className="hover:text-blue-600 dark:hover:text-blue-300 transition py-2 border-b border-blue-200 dark:border-white/30"
                onClick={() => setMenuOpen(false)}
              >
                {item.text}
              </Link>
            ))}

            <Link
              to="/contact"
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition text-center mt-2"
              onClick={() => setMenuOpen(false)}
            >
              Hubungi
            </Link>

          </div>
        </div>
      </header>
    </>
  );
}
