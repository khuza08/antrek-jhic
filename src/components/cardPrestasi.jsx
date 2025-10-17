import { Link } from 'react-router-dom';
import SectionTitle from './sectionTitle';
import achievement1 from '../assets/images/achievement.jpg';
import achievement2 from '../assets/images/achievement.jpg';
import achievement3 from '../assets/images/achievement.jpg';

export default function CardPrestasi() {
  // dummy sementara
  const achievements = [
    {
      id: "1",
      image: achievement1,
      title: "Juara 1 Herex Nasional",
      description: "Memenangkan kompetisi Herex 1200m tingkat nasional terbaik",
      category: "Competition",
      date: "05 Mar 2008",
      rank: "1st Place",
      rating: "4.9"
    },
    {
      id: "2",
      image: achievement2,
      title: "Medali Emas Olimpiade Sains",
      description: "Meraih medali emas dalam olimpiade sains tingkat provinsi",
      category: "Academic",
      date: "22 Aug 2023",
      rank: "Gold Medal",
      rating: "5.0"
    },
    {
      id: "3",
      image: achievement3,
      title: "Juara Keluar Kelas",
      description: "Menjadi tim terbaik dalam kejuaraan keluar kelas, pelajar se-Jawa Timur",
      category: "Sports",
      date: "5 Nov 2023",
      rank: "Champion",
      rating: "4.7"
    }
  ];

  // subcomponent
  const AchievementCard = ({ achievement }) => (
    <div className="group relative bg-white dark:bg-white/5 rounded-xl shadow-lg overflow-hidden 
    transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-200
     dark:border-white/20"
          >
      <div className="h-48 overflow-hidden">
        <img
          src={achievement.image}
          alt={achievement.title}
          className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
        />
      </div>

      {achievement.rank && (
        <div className="absolute top-4 right-4 bg-white/5 border-2 border-white/20 backdrop-blur-sm text-gray-900 px-3 py-1 rounded-full text-sm font-bold shadow-md">
          {achievement.rank}
        </div>
      )}

      <div className="p-5 relative overflow-hidden">
        {/* radia gradiente*/}
        <div className="absolute -right-20 -bottom-30 w-48 h-48 bg-gradient-to-tr from-blue-500/40 to-blue-300/10 rounded-full blur-xl"></div>

        {/* konten card */}
        <div className="relative z-10">
          <div className="flex items-center gap-2 mb-2">
            <span className={`px-2 py-1 text-xs font-semibold rounded-full 
  ${achievement.category === 'Academic'
                ? 'bg-yellow-800 text-yellow-100'
                : achievement.category === 'Competition'
                  ? 'bg-red-800 text-red-100'
                  : 'bg-green-800 text-green-100'
              }
`}>
              {achievement.category}
            </span>
            <span className="text-xs text-gray-500 dark:text-gray-400">
              {achievement.date}
            </span>
          </div>

          <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2" >
            {achievement.title}
          </h3>

          <p className="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
            {achievement.description}
          </p>

          <div className="flex justify-between items-center">
            <div className="flex items-center space-x-1">
              <svg className="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <span className="text-sm font-medium text-gray-900 dark:text-white">
                {achievement.rating}
              </span>
            </div>

            <Link
              to={`/prestasi/${achievement.id}`}
              className="text-sm font-medium text-blue-400 hover:text-blue-500 transition-colors flex items-center"
            >
              Lihat Detail
              <svg className="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
              </svg>
            </Link>
          </div>
        </div>
      </div>
    </div>
  );

  // render 3 card + layout
  return (
    <section className="min-h-screen py-16 bg-blue-100 dark:bg-slate-900 flex items-center justify-center">      
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div className="text-center mb-8" data-aos="fade-in">
        <SectionTitle >
          Prestasi <span className='italic text-blue-600 dark:text-blue-400' style={{ fontFamily: "'Instrument Serif', serif" }}>Terbaru</span>
        </SectionTitle>
        <p className="text-lg text-black/60 dark:text-white max-w-2xl mx-auto">
          Berbagai penghargaan dan prestasi yang telah diraih oleh siswa-siswi kami
        </p>
      </div>

      {/* grid 3 card */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {achievements.map((achievement) => (
          <div key={achievement.id} className="flex justify-center">
            <AchievementCard achievement={achievement} />
          </div>
        ))}
      </div>

      <div className="text-center mt-8">
        <Link
          to="/prestasi"
          className="bg-blue-600 dark:bg-blue-500 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-full text-white hover:bg-blue-700 dark:hover:bg-blue-600 transition shadow-lg hover:shadow-blue-500/20"
        >
          Lihat Semua Prestasi
          <svg className="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
          </svg>
        </Link>
      </div>
    </div>
    </section>
  );
}