import { useEffect, useState } from 'react'

export default function Guru() {
  const [gurus, setGurus] = useState([])

  useEffect(() => {
    fetch('/src/data/guru.json')
      .then(res => res.json())
      .then(data => setGurus(data))
  }, [])

  return (
    <div className="p-6 grid grid-cols-3 gap-4">
      {gurus.map((guru, idx) => (
        <CardGuru key={idx} guru={guru} />
      ))}
    </div>
  )
}
