import kepsekImage from '../assets/images/kepsek.jpeg';

export default function Kepsek() {
  return (
    <section className="flex flex-col md:flex-row bg-blue-100 dark:bg-slate-900 px-6 md:px-12 gap-y-6 md:gap-x-8">
  {/* kolom kiri */}
<div className="w-full md:w-1/2 h-[50vh] sm:h-[60vh] md:h-[70vh] lg:h-[80vh]">
  <img
    src={kepsekImage}
    alt="Kepala Sekolah"
    className="w-full h-full rounded-lg sm:rounded-xl md:rounded-2xl lg:rounded-3xl xl:rounded-4xl object-cover"
  />
</div>

  {/* kolom kanan */}
  <div className="w-full md:w-1/2 flex flex-col items-center md:items-start justify-center py-8 text-center md:text-left">
    <div className="inline-block mb-4">
      <h2 className="text-xl md:text-2xl text-gray-800 dark:text-gray-100 font-semibold">
        Sambutan{' '}
        <span
          className="text-blue-600 dark:text-blue-400 italic"
          style={{ fontFamily: "'Instrument Serif', serif" }}
        >
          Kepala Sekolah
        </span>
      </h2>
    </div>

    <p className="text-black/50 dark:text-white/70 text-base md:text-lg tracking-tight leading-tight">
      Thank God, I never stop saying it because thanks to His grace, grace
      and guidance, our beloved school website, SMK Antarctica 2 Sidoarjo
      was successfully published. I would like to thank the team behind the
      scenes on this website because thanks to its hard work this website
      was finally published to the general public.
    </p>

    <p className="text-black dark:text-white font-bold py-4">- Retno Purwolystiorini, SE., M.M.Pd</p>
    
  </div>
</section>

  );
}