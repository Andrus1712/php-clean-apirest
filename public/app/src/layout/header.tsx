function Header() {
    return (
        <>
            <header className="bg-blue-600 text-white p-4 shadow-md">
                <div className="container mx-auto flex justify-between items-center">
                    <h1 className="text-xl font-bold">Todo List APP</h1>
                    <nav>
                        
                        <div className="lg:flex lg:flex-1 lg:justify-end">
                            <a href="#" className="text-sm/6 font-semibold text-white">Log in <span
                                aria-hidden="true">&rarr;</span></a>
                        </div>
                    </nav>
                </div>
            </header>
        
        </>
    );
}

export default Header;
