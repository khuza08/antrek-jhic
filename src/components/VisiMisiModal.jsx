import { useState } from 'react';

export default function VisiMisiModal({ isOpen, onClose }) {
  const [activeTab, setActiveTab] = useState('misi');

  if (!isOpen) return null;

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
      onClick={onClose}
    >
      <div
        className="relative w-full max-w-4xl max-h-[90vh] bg-slate-800 rounded-xl shadow-2xl border border-slate-700 overflow-hidden"
        onClick={(e) => e.stopPropagation()}
      >
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-4 right-4 text-black dark:text-white hover:text-white z-10"
        >
          <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        {/* Pill Toggle */}
        <div className="flex bg-slate-700/50 rounded-full p-1 mx-6 mt-6 mb-4 w-fit">
          <button
            className={`px-6 py-2 rounded-full text-sm font-medium transition-colors ${
              activeTab === 'visi'
                ? 'bg-slate-700 text-white'
                : 'text-slate-300 hover:bg-slate-700/50'
            }`}
            onClick={() => setActiveTab('visi')}
          >
            Visi
          </button>
          <button
            className={`px-6 py-2 rounded-full text-sm font-medium transition-colors ${
              activeTab === 'misi'
                ? 'bg-slate-700 text-white'
                : 'text-slate-300 hover:bg-slate-700/50'
            }`}
            onClick={() => setActiveTab('misi')}
          >
            Misi
          </button>
        </div>

        {/* Scrollable Content */}
        <div className="px-6 pb-6 max-h-[70vh] overflow-y-auto">
          {activeTab === 'visi' ? (
            <div>
              <h2 className="text-xl font-bold text-white mb-3">Visi Kami</h2>
              <div className="bg-slate-700 rounded-xl p-5">
                <p className="text-slate-100 dark:text-white italic">
                  "Menjadi lembaga pendidikan unggulan yang mengintegrasikan nilai keagamaan, karakter, dan kompetensi berbasis teknologi untuk menghasilkan generasi berakhlak mulia, berjiwa wirausaha, dan siap menjadi Agent of Change di era industri 4.0."
                </p>
              </div>
            </div>
          ) : (
            <div>
              <h2 className="text-xl font-bold text-white mb-3">Misi Kami</h2>
              <ol className="list-decimal pl-5 space-y-2 text-slate-200">
                <li>Melaksanakan kegiatan keagamaan sebagai dasar pembentukan budi pekerti luhur, beriman dan bertaqwa terhadap Tuhan YME.</li>
                <li>Membina, melaksanakan, dan menumbuhkan budaya disiplin berkarakter.</li>
                <li>Membekali peserta didik dengan konsep industri 4.0 menuju Agent Of Change.</li>
                <li>Mengoptimalkan teknologi informasi dalam mendukung pembelajaran, kewirausahaan, dan manajemen sekolah.</li>
                <li>Mengembangkan skema kompetensi dan uji kompetensi Lembaga Sertifikasi Profesi (LSP)-PI.</li>
                <li>Meningkatkan prestasi peserta didik melalui kegiatan intrakurikuler dan ekstrakurikuler.</li>
                <li>Membina peserta didik berjiwa kewirausahaan melalui pembelajaran projek kreatif dan kewirausahaan.</li>
                <li>Bekerjasama dengan industri yang berskala nasional.</li>
              </ol>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}