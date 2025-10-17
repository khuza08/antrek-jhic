import { useEffect } from "react";

export default function Login() {
  useEffect(() => {
    window.location.replace("http://localhost:8000");
  }, []);

  return null; // Tidak render apa-apa karena langsung redirect
}
