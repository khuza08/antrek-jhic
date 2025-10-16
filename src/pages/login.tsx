// import React, { useState, FormEvent } from "react";
// import { Link } from "react-router-dom";

// const Login: React.FC = () => {
//   const [email, setEmail] = useState<string>("");
//   const [password, setPassword] = useState<string>("");
//   const [error, setError] = useState<string>("");
//   const [errorMessage, setErrorMessage] = useState<string>("")

//   const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
//     e.preventDefault();

//     try{
//       const response = await fetch("http://localhost:8000/api/login", {
//         method : "POST",
//         credentials: "include",
//         mode : "cors",
//         headers : {
//           Accept : "application/json",
//           "Content-Type" : "application/json",
//         },
//         body : JSON.stringify({
//           email : email,
//           password : password,
//         })
//       })

//       if (response.ok){
//         const data = await response.json()
//         console.log(data)
//         window.location.href = "http://localhost:8000"
//       } else {
//         const data = await response.json()
//         setErrorMessage(data.message || "Unathorized User!")
//       }
//     } catch (err) {
//       console.log("ERROR failed to fetch", err)
//       setErrorMessage("Unathorized User!")
//     }

//     if (!email.trim()) {
//       setError("Username harus diisi");
//       return;
//     }
//     if (!password.trim()) {
//       setError("Password harus diisi");
//       return;
//     }

//     // setError("");
//     // alert(`Login dengan\nUsername: ${username}\nPassword: ${password}`);
//   };

//   return (
//     <div className="w-full min-h-screen flex flex-col justify-center items-center bg-gradient-to-b from-blue-100 to-white dark:from-slate-900 dark:to-gray-800 p-6">
//       <div className="bg-white dark:bg-slate-800 rounded-xl p-8 shadow-lg border border-gray-200 dark:border-slate-700 max-w-md w-full">
//         <h3 className="text-xl font-semibold text-gray-800 dark:text-white mb-6 text-center">
//           Login
//         </h3>

//         {error && (
//           <div className="mb-4 p-2 bg-red-200 text-red-700 rounded">{error}</div>
//         )}

//         <form className="space-y-6" onSubmit={handleSubmit}>
//           <div>
//             <label
//               htmlFor="email"
//               className="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2"
//             >
//               Email
//             </label>
//             <input
//               id="email"
//               type="text"
//               name="email"
//               value={email}
//               onChange={(e) => setEmail(e.target.value)}
//               placeholder="Masukkan email"
//               className="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
//               required
//             />
//           </div>

//           <div>
//             <label
//               htmlFor="password"
//               className="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2"
//             >
//               Password
//             </label>
//             <input
//               id="password"
//               type="password"
//               name="password"
//               value={password}
//               onChange={(e) => setPassword(e.target.value)}
//               placeholder="Masukkan password"
//               className="w-full px-4 py-3 bg-gray-50 dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-lg text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
//               required
//             />
//           </div>

//           <p className="text-red-500">{errorMessage}</p>

//           <button
//             type="submit"
//             className="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 shadow-lg hover:shadow-blue-500/20"
//           >
//             Login
//           </button>
//         </form>
//       </div>

//       {/* regis */}
//       <div className="mt-4 text-center">
//         <span className="text-gray-700 dark:text-gray-300">
//           Belum punya akun?{" "}
//           <Link
//             to="/register"
//             className="text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400 font-semibold"
//           >
//             Daftar di sini
//           </Link>
//         </span>
//       </div>
//     </div>
//   );
// };

// export default Login;
// src/pages/login.jsx
import { useEffect } from "react";

export default function Login() {
  useEffect(() => {
    window.location.replace("http://localhost:8000");
  }, []);

  return null; // Tidak render apa-apa karena langsung redirect
}
