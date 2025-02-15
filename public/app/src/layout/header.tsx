import {useAppSelector} from "../hooks";

function Header() {
    const {name} = useAppSelector(state => state.users);
    return (
        <>
            <header className="bg-blue-600 text-white p-4 shadow-md">
                <div className="container mx-auto flex justify-between items-center">
                    <h1 className="text-2xl font-bold text-center mb-4">📝 To-Do List</h1>
                    <nav>
                        {name !== "" ?
                            <div className="flex flex-row lg:flex-1 justify-end gap-3 align-middle items-center">
                                <p className="text-white">{name}</p>
                                <a href="/login"
                                   className="text-sm/6 font-semibold text-white hover:bg-amber-50 rounded hover:text-blue-700 p-1">Logout<span
                                    aria-hidden="true">&rarr;</span></a>
                            </div>
                            :
                            null
                        }
                    </nav>
                </div>
            </header>
        
        </>
    );
}

export default Header;
