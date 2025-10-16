import React from 'react';
import logoImage from '../assets/images/logo_embed.png';


export default function Footer() {
  return (
    <footer className="bg-gradient-to-b from-blue-100 bg-white dark:from-slate-900 dark:bg-gray-800 
    text-white py-8 px-18">

      <div className="bg-gray-900/10 backdrop-blur-lg w-full max-w-8xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 p-6 md:p-8 rounded-2xl border-4 border-gray-800">

       {/* Kolom 1: Logo & Info Sekolah */}
        <div className="flex flex-col justify-between h-full">
          {/* Bagian Atas: Logo + Info Kontak */}
          <div>
            <div className="flex items-center mb-6">
              <img
                src={logoImage}
                alt="Logo SMK Antartika Sidoarjo"
                className="w-auto h-auto mr-3" // pastikan ukuran konsisten
              />
            </div>

            <div className="space-y-4 text-sm">
              <div>
                <strong>Alamat:</strong><br />
                Jl. Raya Siwalanpanji No.6, Bedrek, Siwalanpanji, Kec. Buduran, Kabupaten Sidoarjo, Jawa Timur 61252
              </div>
              <div>
                <strong>Telepon:</strong> 031-99711858
              </div>
              <div>
                <strong>Surel:</strong> ntrek-sda.sch.id
              </div>
            </div>
          </div>

          {/* === SOSIAL MEDIA DI BAWAH SENDIRI (dalam kolom yang sama) === */}
          <div className="flex justify-start space-x-4 mt-6 pt-4 border-t border-gray-700">
            {/* Instagram */}
            <a
              href="https://instagram.com/antartika2sda"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Instagram"
              className="bg-gray-700 p-2 rounded-full hover:bg-gray-600 transition"
            >
              <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </a>

            {/* Facebook */}
            <a
              href="https://facebook.com/antartika2sda"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="Facebook"
              className="bg-gray-700 p-2 rounded-full hover:bg-gray-600 transition"
            >
              <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>

            {/* GitHub */}
            <a
              href="https://github.com/antartika2sda"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="GitHub"
              className="bg-gray-700 p-2 rounded-full hover:bg-gray-600 transition"
            >
              <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
              </svg>
            </a>
          </div>
        </div>

        

        {/* Kolom 2: Link & Visitor Counter */}
        <div>
          <h3 className="font-semibold mb-4">Link</h3>
          <ul className="space-y-2 text-sm mb-6">
            <li><a href="#" className="hover:text-blue-400">iGracias for TS</a></li>
            <li><a href="#" className="hover:text-blue-400">Pendafataran Sekolah</a></li>
          </ul>

          <h3 className="font-semibold mb-4">Jumlah Pengunjung</h3>
          <div className="bg-black px-4 py-3 rounded-md mb-4">
            <div className="text-2xl font-mono font-bold">023093</div>
          </div>

          <div className="space-y-2 text-sm">
            <div className="flex items-center">
              <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
              <span>Users Today : 33</span>
            </div>
            <div className="flex items-center">
              <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H7a1 1 0 00-1 1v1z" clipRule="evenodd"/></svg>
              <span>Users This Month : 979</span>
            </div>
            <div className="flex items-center">
              <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H7a1 1 0 00-1 1v1z" clipRule="evenodd"/></svg>
              <span>Users This Year : 17107</span>
            </div>
            <div className="flex items-center">
              <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM3 16a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clipRule="evenodd"/></svg>
              <span>Total Users : 23093</span>
            </div>
            <div className="flex items-center">
              <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM3 16a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clipRule="evenodd"/></svg>
              <span>Views Today : 168</span>
            </div>
            <div className="flex items-center">
              <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM3 16a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clipRule="evenodd"/></svg>
              <span>Total views : 56823</span>
            </div>
          </div>
        </div>

        {/* Kolom 3: Lokasi Sekolah (Google Maps) */}
        <div>
          <h3 className="font-semibold mb-4">Lokasi Sekolah</h3>
          <div className="space-y-4">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.133840626677!2d112.7257401!3d-7.4335229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6a886bb12af%3A0xfd09f08967a2d26f!2sSMK%20Antartika%202%20Sidoarjo!5e0!3m2!1sen!2sid!4v1734330000000!5m2!1sen!2sid"
              style={{ border: 0 }}
              allowFullScreen
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
              title="Lokasi SMK Antartika 2 Sidoarjo"
              className="w-full h-64 md:h-80 rounded-lg"
            ></iframe>
          </div>
        </div>
        
      </div>

      <p className="flex items-center justify-center text-white/50"
      >alderlake © Copyright 2025. All Rights Reserved.
      </p>

    </footer>
  );
}