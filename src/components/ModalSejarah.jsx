// src/components/ModalSejarah.jsx
import { useEffect } from 'react';

export default function ModalSejarah({ isOpen, onClose }) {
  if (!isOpen) return null;

  // Lock scroll when modal is open
  useEffect(() => {
    document.body.style.overflow = 'hidden';
    return () => {
      document.body.style.overflow = 'auto';
    };
  }, []);

  const handleOverlayClick = (e) => {
    if (e.target === e.currentTarget) {
      onClose();
    }
  };

  const handleKeyDown = (e) => {
    if (e.key === 'Escape') {
      onClose();
    }
  };

  useEffect(() => {
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [onClose]);

  return (
    <div
      className="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      onClick={handleOverlayClick}
    >
      <div className="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full p-6 relative">
        {/* Close button */}
        <button
          onClick={onClose}
          className="absolute top-3 right-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-xl font-bold"
        >
          ×
        </button>

        {/* Header */}
        <h2 className="text-xl font-bold text-blue-700 dark:text-blue-300 mb-4">SEJARAH</h2>

        {/* Content */}
        <div className="space-y-3 text-gray-800 dark:text-gray-200">
          <p>
            SMK Antartika 2 Sidoarjo berdiri sejak 10 Mei 2002 di bawah naungan Yayasan Pendidikan Wahyuhana. Sekolah ini telah menjadi salah satu SMK unggulan di Jawa Timur.
          </p>
          <p>
            Dengan fokus pada inovasi dan teknologi, SMK Antartika 2 ditetapkan sebagai SMK Revolusi Industri 4.0 oleh Kemendikbud Ristek pada 18 Oktober 2021.
          </p>
          <p>
            Sekolah ini terus berkembang dan mencetak lulusan kompeten yang siap bersaing di dunia kerja serta industri modern.
          </p>
        </div>
      </div>
    </div>
  );
}