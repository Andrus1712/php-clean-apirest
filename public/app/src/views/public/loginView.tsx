import {useState} from "react";
import {useAuthUserMutation} from "../../api/authApi.ts";
import {useAppDispatch} from "../../hooks";
import {add_Token} from "../../features";
import {useNavigate} from "react-router-dom";

function LoginView() {
    
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [authUser, {isLoading, error}] = useAuthUserMutation();
    const dispatch = useAppDispatch();
    const navigate = useNavigate();
    
    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            const result = await authUser({email, password}).unwrap();
            dispatch(add_Token(result.token));
            navigate("/dashboard");
        } catch (err) {
            console.error("Error de autenticación:", err);
        }
    };
    
    
    return (<div className="flex items-center justify-center min-h-screen bg-gray-100">
        <div className="w-full max-w-sm bg-white p-6 rounded-lg shadow-md">
            <h2 className="text-2xl font-bold text-center text-gray-700">Iniciar Sesión</h2>
            <form className="mt-4" onSubmit={handleSubmit}>
                <div>
                    <label className="block text-sm font-medium text-gray-600">Correo electrónico</label>
                    <input
                        type="email"
                        className="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="correo@ejemplo.com"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                    />
                </div>
                <div className="mt-4">
                    <label className="block text-sm font-medium text-gray-600">Contraseña</label>
                    <input
                        type="password"
                        className="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="••••••••"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                    />
                </div>
                {error && (
                    <p className="mt-2 text-sm text-red-500">Error en las credenciales</p>
                )}
                <button
                    type="submit"
                    className="w-full px-4 py-2 mt-4 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600"
                    disabled={isLoading}
                >
                    {isLoading ? "Cargando..." : "Iniciar Sesión"}
                </button>
            </form>
        </div>
    </div>);
}

export default LoginView;
