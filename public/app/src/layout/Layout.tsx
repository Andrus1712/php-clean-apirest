import {ReactNode} from 'react';
import Header from "./header.tsx";

function Layout({children}: { children: ReactNode }) {
    return (
        <>
            <Header/>
            {children}
        </>
    );
}

export default Layout;
