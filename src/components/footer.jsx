import React from 'react';
import logoImage from '../assets/images/logo_embed.png';


export default function Footer() {
  return (
    <footer className="bg-gradient-to-b from-blue-100 bg-white dark:from-slate-900 dark:bg-gray-800 
    text-white py-18 px-18">

      <div className="bg-gray-900/10 backdrop-blur-lg w-full max-w-8xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 p-6 md:p-8 rounded-2xl border-4 border-gray-800">

        {/* Kolom 1: Logo & Info Sekolah */}
        <div>

        <div className="flex items-center mb-6">
          <img
            src={logoImage}
            alt="Logo SMK Antartika Sidoarjo"
            className="w-auto h-auto mr-3"
          />
          <div>
          </div>
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
    </footer>
  );
}