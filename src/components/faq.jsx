import React from 'react';

export default function Faq() {
  const faqs = [
    { 
      q: "Bagaimana cara mendaftar?", 
      a: "Kamu bisa mendaftar melalui halaman PPDB di website kami atau datang langsung ke sekolah." 
    },
    { 
      q: "Apakah ada ekstrakurikuler?", 
      a: "Ya, kami menyediakan berbagai ekstrakurikuler seperti olahraga, seni, sains, dan kegiatan kepemudaan." 
    },
    { 
      q: "Apa saja fasilitas yang tersedia?", 
      a: "Kami memiliki laboratorium lengkap, perpustakaan modern, lapangan olahraga, dan ruang belajar yang nyaman." 
    },
    { 
      q: "Bagaimana sistem pembelajarannya?", 
      a: "Kami menggunakan kurikulum nasional yang diperkaya dengan pendekatan pembelajaran aktif dan kreatif." 
    },
  ]

  return (
    <section className="w-full bg-blue-100 dark:bg-slate-900 py-16">
      <div className="max-w-3xl mx-auto px-4">
        <h2 className="text-3xl font-bold text-center mb-12 text-gray-800 dark:text-white" data-aos="fade-in">
          Frequently <span className='italic text-blue-600 dark:text-blue-400 text-4xl' style={{ fontFamily: "'Instrument Serif', serif" }}>Asked</span> Question.
        </h2>
        
        <div className="space-y-4" data-aos="fade-up">
          {faqs.map((faq, idx) => (
            <div 
              key={idx} 
              className="group bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl overflow-hidden transition-all duration-200 hover:border-blue-500"
            >
              <details className="p-6">
                <summary className="flex justify-between items-center cursor-pointer list-none">
                  <span className="text-lg font-medium text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400">
                    {faq.q}
                  </span>
                  <svg 
                    className="w-5 h-5 text-gray-500 dark:text-slate-400 group-hover:text-blue-500 dark:group-hover:text-blue-400 transition-transform duration-200"
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                  >
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                  </svg>
                </summary>
                <p className="mt-4 text-gray-600 dark:text-slate-300">
                  {faq.a}
                </p>
              </details>
            </div>
          ))}
        </div>
      </div>

      <style jsx>{`
        details[open] > summary > svg {
          transform: rotate(180deg);
        }
      `}</style>
    </section>
  )
}