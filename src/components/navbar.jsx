// src/components/Header.jsx
import { useState, useEffect, useCallback, useRef } from 'react';
import { Link } from 'react-router-dom';
import logoLight from '../assets/images/logo_embed.png';
import logoDark from '../assets/images/logo_embed_dark.png';
import ContactFormModal from './ContactFormModal';
import VisiMisiModal from './VisiMisiModal';
import ModalSejarah from './ModalSejarah';

export default function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [showContactForm, setShowContactForm] = useState(false);
  const [showVisiMisi, setShowVisiMisi] = useState(false);
  const [showSejarah, setShowSejarah] = useState(false); 
  const [mobileDropdowns, setMobileDropdowns] = useState({
    tentang: false,
    guru: false,
  });

  const mobileMenuRef = useRef(null);

  const [logoSrc, setLogoSrc] = useState(() => {
    if (typeof window === 'undefined') return logoLight;
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    return prefersDark ? logoLight : logoDark;
  });

  useEffect(() => {
    document.body.style.overflow = menuOpen || showContactForm || showVisiMisi || showSejarah ? 'hidden' : 'auto';
    return () => {
      document.body.style.overflow = 'auto';
    };
  }, [menuOpen, showContactForm, showVisiMisi, showSejarah]);

  const handleKeyDown = useCallback((e) => {
    if (e.key === 'Escape') {
      setShowContactForm(false);
      setShowVisiMisi(false);
      setShowSejarah(false);
      setMenuOpen(false);
      setMobileDropdowns({ tentang: false, guru: false });
    }
  }, []);

  useEffect(() => {
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [handleKeyDown]);

  useEffect(() => {
    const handleClickOutside = (e) => {
      if (mobileMenuRef.current && !mobileMenuRef.current.contains(e.target)) {
        setMenuOpen(false);
        setMobileDropdowns({ tentang: false, guru: false });
      }
    };
    if (menuOpen) {
      document.addEventListener('mousedown', handleClickOutside);
    } else {
      document.removeEventListener('mousedown', handleClickOutside);
    }
    return () => document.removeEventListener('mousedown', handleClickOutside);
  }, [menuOpen]);

  // Scrolled effect
  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 30);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const openContactForm = () => setShowContactForm(true);
  const closeMobileMenu = () => {
    setMenuOpen(false);
    setMobileDropdowns({ tentang: false, guru: false });
  };

  const toggleMobileDropdown = (name) => {
    setMobileDropdowns((prev) => {
      const reset = { tentang: false, guru: false };
      reset[name] = !prev[name];
      return reset;
    });
  };

  return (
    <>
      {/* Mobile overlay */}
      {menuOpen && (
        <div
          className="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-lg z-40 md:hidden"
          onClick={closeMobileMenu}
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
          {/* Logo */}
          <div className="absolute left-6">
            <Link to="/" className="flex items-center" onClick={closeMobileMenu}>
              <img
                src={logoSrc}
                alt="SMK Antartika 2 Sidoarjo"
                className="h-10 md:h-11 w-auto object-contain"
              />
            </Link>
          </div>

          {/* Desktop Nav */}
          <nav className="hidden md:flex space-x-8 items-center justify-center">
            <Link to="/" className="hover:text-blue-600 dark:hover:text-blue-300 transition">
              Beranda
            </Link>

            {/* Tentang Dropdown - Desktop */}
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
                <button
                  onClick={(e) => {
                    e.preventDefault();
                    setShowSejarah(true);
                  }}
                  className="w-full text-left px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Sejarah
                </button>
                <button
                  onClick={(e) => {
                    e.preventDefault();
                    setShowVisiMisi(true);
                  }}
                  className="w-full text-left px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Visi & Misi
                </button>
              </div>
            </div>

            {/* Guru Dropdown - Desktop */}
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
                  to="/guru"
                  className="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-lg"
                >
                  Daftar Guru
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

          {/* Desktop Contact Button */}
          <div className="absolute right-6 hidden md:block">
            <button
              onClick={openContactForm}
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition"
            >
              Kontak
            </button>
          </div>

          {/* Mobile Menu Button */}
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

        {/* Mobile Menu with Dropdowns */}
        <div
          ref={mobileMenuRef}
          className={`md:hidden ${menuOpen ? 'block' : 'hidden'} bg-gradient-to-b from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur-lg pb-4 relative z-50`}
        >
          <div className="flex flex-col space-y-1 px-6 py-2 text-gray-900 dark:text-white">
            <Link to="/" className="py-3 hover:text-blue-600 dark:hover:text-blue-300 transition border-b border-blue-200 dark:border-white/30" onClick={closeMobileMenu}>
              Beranda
            </Link>

            {/* Mobile Tentang Dropdown */}
            <div className="relative">
              <button
                onClick={() => toggleMobileDropdown('tentang')}
                className="flex w-full justify-between items-center py-3 hover:text-blue-600 dark:hover:text-blue-300 transition border-b border-blue-200 dark:border-white/30"
              >
                Tentang
                <svg
                  className={`w-4 h-4 transition-transform duration-200 ${mobileDropdowns.tentang ? 'rotate-180' : ''}`}
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              {mobileDropdowns.tentang && (
                <div className="ml-4 mt-1 space-y-2 border-l-2 border-blue-300 dark:border-blue-500 pl-3">
                  <button
                    onClick={() => {
                      closeMobileMenu();
                      setShowSejarah(true);
                    }}
                    className="block text-left py-2 hover:text-blue-600 dark:hover:text-blue-300 transition"
                  >
                    Sejarah
                  </button>
                  <button
                    onClick={() => {
                      closeMobileMenu();
                      setShowVisiMisi(true);
                    }}
                    className="block text-left py-2 hover:text-blue-600 dark:hover:text-blue-300 transition"
                  >
                    Visi & Misi
                  </button>
                </div>
              )}
            </div>

            {/* Mobile Guru Dropdown */}
            <div className="relative">
              <button
                onClick={() => toggleMobileDropdown('guru')}
                className="flex w-full justify-between items-center py-3 hover:text-blue-600 dark:hover:text-blue-300 transition border-b border-blue-200 dark:border-white/30"
              >
                Guru
                <svg
                  className={`w-4 h-4 transition-transform duration-200 ${mobileDropdowns.guru ? 'rotate-180' : ''}`}
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              {mobileDropdowns.guru && (
                <div className="ml-4 mt-1 space-y-2 border-l-2 border-blue-300 dark:border-blue-500 pl-3">
                  <Link to="/guru" className="block py-2 hover:text-blue-600 dark:hover:text-blue-300 transition" onClick={closeMobileMenu}>
                    Daftar Guru
                  </Link>
                </div>
              )}
            </div>

            <Link to="/achievements" className="py-3 hover:text-blue-600 dark:hover:text-blue-300 transition border-b border-blue-200 dark:border-white/30" onClick={closeMobileMenu}>
              Prestasi
            </Link>
            <Link to="/gallery" className="py-3 hover:text-blue-600 dark:hover:text-blue-300 transition border-b border-blue-200 dark:border-white/30" onClick={closeMobileMenu}>
              Galeri
            </Link>

            <button
              onClick={() => {
                closeMobileMenu();
                openContactForm();
              }}
              className="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition text-center mt-2"
            >
              Kontak
            </button>
          </div>
        </div>
      </header>

      {/* Modals — include ModalSejarah */}
      <ContactFormModal isOpen={showContactForm} onClose={() => setShowContactForm(false)} />
      <VisiMisiModal isOpen={showVisiMisi} onClose={() => setShowVisiMisi(false)} />
      <ModalSejarah isOpen={showSejarah} onClose={() => setShowSejarah(false)} />
    </>
  );
}