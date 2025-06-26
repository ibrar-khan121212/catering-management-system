import { SVGAttributes } from 'react';

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    return (
        <svg
    {...props}
    viewBox="0 0 64 64"
    xmlns="http://www.w3.org/2000/svg"
    fill="currentColor"
>
    {/* Serving tray dome */}
    <path d="M32 12C20.954 12 12 20.954 12 32H52C52 20.954 43.046 12 32 12Z" />
    {/* Tray base */}
    <rect x="16" y="32" width="32" height="4" rx="2" />
    {/* Tray plate */}
    <rect x="12" y="38" width="40" height="4" rx="2" />
    
    {/* Steam lines (for hot food) */}
    <path d="M24 8C24 6 25 5 26 4" stroke="currentColor" strokeWidth="2" />
    <path d="M32 6C32 4 33 3 34 2" stroke="currentColor" strokeWidth="2" />
    <path d="M40 8C40 6 41 5 42 4" stroke="currentColor" strokeWidth="2" />
</svg>

    );
}
