import { useState, useEffect, useCallback } from 'react';
import { Link } from 'react-router-dom';
import logoLight from '../assets/images/logo_embed.png';        // white text (for dark mode)
import logoDark from '../assets/images/logo_embed_dark.png';    // black text (for light mode)

export default function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [showContactForm, setShowContactForm] = useState(false);
  const [isClosing, setIsClosing] = useState(false);

  // Detect OS theme ONCE at mount
  const [logoSrc, setLogoSrc] = useState(() => {
    if (typeof window === 'undefined') return logoLight;
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    return prefersDark ? logoLight : logoDark;
  });

  // Lock body scroll when mobile menu or contact form is open
  useEffect(() => {
    document.body.style.overflow = menuOpen || showContactForm ? 'hidden' : 'auto';
    return () => {
      document.body.style.overflow = 'auto';
    };
  }, [menuOpen, showContactForm]);

  // Close contact form on Escape key
  const handleKeyDown = useCallback((e) => {
    if (e.key === 'Escape' && showContactForm) {
      closeContactForm();
    }
  }, [showContactForm]);

  useEffect(() => {
    window.addEventListener('keydown', handleKeyDown);
    return () => {
      window.removeEventListener('keydown', handleKeyDown);
    };
  }, [handleKeyDown]);

  // Detect scroll for header styling
  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 30);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const openContactForm = () => {
    setIsClosing(false);
    setShowContactForm(true);
  };

  const closeContactForm = () => {
    if (!showContactForm) return;
    setIsClosing(true);
    setTimeout(() => {
      setShowContactForm(false);
      setIsClosing(false);
    }, 300); // match Tailwind duration-300
  };

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
            <Link to="/" className="flex items-center" onClick={closeContactForm}>
              <img
                src={logoSrc}
                alt="SMK Antartika 2 Sidoarjo"
                className="h-10 md:h-11 w-auto object-contain"
              />
            </Link>
          </div>

          {/* Centered desktop navigation */}
          <nav className="hidden md:flex space-x-8 items-center justify-center">
            <Link to="/" className="hover:text-blue-600 dark:hover:text-blue-300 transition" onClick={closeContactForm}>
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
                  onClick={closeContactForm}
                >
                  Sejarah
                </Link>
                <Link
                  to="/tentang/visi-misi"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                  onClick={closeContactForm}
                >
                  Visi & Misi
                </Link>
                <Link
                  to="/tentang/struktur"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                  onClick={closeContactForm}
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
                  onClick={closeContactForm}
                >
                  Daftar Guru
                </Link>
                <Link
                  to="/guru/staf"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                  onClick={closeContactForm}
                >
                  Staf Pengajar
                </Link>
              </div>
            </div>

            <Link to="/achievements" className="hover:text-blue-600 dark:hover:text-blue-300 transition" onClick={closeContactForm}>
              Prestasi
            </Link>
            <Link to="/gallery" className="hover:text-blue-600 dark:hover:text-blue-300 transition" onClick={closeContactForm}>
              Galeri
            </Link>
          </nav>

          {/* button - desktop */}
          <div className="absolute right-6 hidden md:block">
            <button
              onClick={openContactForm}
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition"
            >
              Kontak
            </button>
          </div>

          {/* Mobile menu button */}
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
                onClick={() => {
                  setMenuOpen(false);
                  closeContactForm();
                }}
              >
                {item.text}
              </Link>
            ))}

            <button
              onClick={() => {
                setMenuOpen(false);
                openContactForm();
              }}
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition text-center mt-2"
            >
              Kontak
            </button>
          </div>
        </div>
      </header>

      {/* Contact Form Overlay with fade animation */}
      {showContactForm && (
        <>
          <div
            className={`fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity duration-300 ${
              isClosing ? 'opacity-0' : 'opacity-100'
            }`}
            onClick={closeContactForm}
          />
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div
              className={`bg-white dark:bg-slate-800 rounded-xl p-8 shadow-lg border border-gray-200 dark:border-slate-700 w-full max-w-md relative transition-all duration-300 ease-out ${
                isClosing ? 'opacity-0 scale-95' : 'opacity-100 scale-100'
              }`}
              onClick={(e) => e.stopPropagation()}
            >
              {/* Close (×) button */}
              <button
                onClick={closeContactForm}
                className="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-slate-400 dark:hover:text-slate-300 focus:outline-none"
                aria-label="Close form"
              >
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>

              <h3 className="text-xl font-semibold text-gray-800 dark:text-white mb-6 text-center">
                Kirim Pesan
              </h3>
              <form
                className="space-y-6"
                onSubmit={(e) => {
                  e.preventDefault();
                  // TODO: handle form submission logic
                  closeContactForm();
                }}
              >
                <div className="grid md:grid-cols-2 gap-6">
                  <div>
                    <label htmlFor="name" className="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                      Nama Lengkap
                    </label>
                    <input
                      type="text"
                      id="name"
                      className="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                      placeholder="Masukkan nama Anda"
                      required
                    />
                  </div>
                  <div>
                    <label htmlFor="email" className="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                      Email
                    </label>
                    <input
                      type="email"
                      id="email"
                      className="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                      placeholder="email@contoh.com"
                      required
                    />
                  </div>
                </div>
                <div>
                  <label htmlFor="subject" className="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                    Subjek
                  </label>
                  <input
                    type="text"
                    id="subject"
                    className="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Apa yang ingin Anda tanyakan?"
                    required
                  />
                </div>
                <div>
                  <label htmlFor="message" className="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                    Pesan
                  </label>
                  <textarea
                    id="message"
                    rows={5}
                    className="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tulis pesan Anda disini..."
                    required
                  ></textarea>
                </div>
                <button
                  type="submit"
                  className="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 shadow-lg hover:shadow-blue-500/20"
                >
                  Kirim Pesan
                </button>
              </form>
            </div>
          </div>
        </>
      )}
    </>
  );
}