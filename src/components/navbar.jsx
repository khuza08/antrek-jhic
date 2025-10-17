import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import logoLight from '../assets/images/logo_embed.png';        // for dark mode (white logo)
import logoDark from '../assets/images/logo_embed_dark.png';    // for light mode (dark logo)

export default function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [logoSrc, setLogoSrc] = useState(logoLight); // default to light-mode (dark) logo

  // Update logo when theme changes
  useEffect(() => {
    const updateLogo = () => {
      const isDark = document.documentElement.classList.contains('dark');
      setLogoSrc(isDark ? logoLight : logoDark);
    };

    updateLogo(); // initial check

    // Observe class changes on <html> to detect theme toggle
    const observer = new MutationObserver(updateLogo);
    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ['class'],
    });

    return () => observer.disconnect();
  }, [logoLight, logoDark]);

  // Lock body scroll when mobile menu is open
  useEffect(() => {
    document.body.style.overflow = menuOpen ? 'hidden' : 'auto';
    return () => {
      document.body.style.overflow = 'auto';
    };
  }, [menuOpen]);

  // Detect scroll for header styling
  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 30);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <>
      {/* Dim overlay for mobile menu */}
      {menuOpen && (
        <div
          className="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-lg z-40 md:hidden"
          onClick={() => setMenuOpen(false)}
        />
      )}

      <header
        className={`fixed py-1 top-0 left-0 right-0 border-b border-blue-200 dark:border-white/25 text-gray-900 dark:text-white z-50 transition-colors duration-300 ${
          scrolled
            ? 'bg-gradient-to-r from-blue-50/70 to-indigo-50/70 dark:from-gray-900/70 dark:to-gray-800/70 backdrop-blur-lg'
            : 'bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800'
        }`}
      >
        <div className="max-w-7xl mx-auto flex items-center justify-center py-4 px-6 relative">
          {/* Logo - left */}
          <div className="absolute left-6">
            <Link to="/" className="flex items-center">
              <img
                src={logoSrc}
                alt="SMK Antartika 2 Sidoarjo"
                className="h-10 md:h-11 w-auto object-contain"
              />
            </Link>
          </div>

          {/* Centered desktop navigation (without "Hubungi") */}
          <nav className="hidden md:flex space-x-8 items-center justify-center">
            <Link to="/" className="hover:text-blue-600 dark:hover:text-blue-300 transition">
              Beranda
            </Link>

            {/* Dropdown: Tentang */}
            <div className="relative group">
              <button className="flex items-center hover:text-blue-600 dark:hover:text-blue-300 transition">
                Tentang
                <svg
                  className="ml-1 w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div className="absolute left-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <Link
                  to="/tentang/sejarah"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Sejarah
                </Link>
                <Link
                  to="/tentang/visi-misi"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Visi & Misi
                </Link>
                <Link
                  to="/tentang/struktur"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Struktur Organisasi
                </Link>
              </div>
            </div>

            {/* Dropdown: Guru */}
            <div className="relative group">
              <button className="flex items-center hover:text-blue-600 dark:hover:text-blue-300 transition">
                Guru
                <svg
                  className="ml-1 w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div className="absolute left-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <Link
                  to="/guru/daftar"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Daftar Guru
                </Link>
                <Link
                  to="/guru/staf"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Staf Pengajar
                </Link>
              </div>
            </div>

            <Link to="/achievements" className="hover:text-blue-600 dark:hover:text-blue-300 transition">
              Prestasi
            </Link>
            <Link to="/gallery" className="hover:text-blue-600 dark:hover:text-blue-300 transition">
              Galeri
            </Link>
          </nav>

          {/* "Hubungi" button - right (desktop only) */}
          <div className="absolute right-6 hidden md:block">
            <Link
              to="/contact"
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition"
            >
              Hubungi
            </Link>
          </div>

          {/* Mobile menu button - right (mobile only) */}
          <div className="absolute right-6 md:hidden">
            <button
              onClick={() => setMenuOpen(!menuOpen)}
              className="focus:outline-none text-blue-700 dark:text-blue-400"
            >
              <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {menuOpen ? (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                ) : (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                )}
              </svg>
            </button>
          </div>
        </div>

        {/* Mobile menu */}
        <div
          className={`md:hidden ${menuOpen ? 'block' : 'hidden'} bg-gradient-to-b from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur-lg pb-4 relative z-50`}
        >
          <div className="flex flex-col space-y-4 px-6 py-2 text-gray-900 dark:text-white">
            {[
              { to: '/', text: 'Beranda' },
              { to: '/tentang', text: 'Tentang' },
              { to: '/guru', text: 'Guru' },
              { to: '/achievements', text: 'Prestasi' },
              { to: '/gallery', text: 'Galeri' },
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