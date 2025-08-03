import { SVGAttributes } from 'react';

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    return (
        <svg {...props} viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L2 7L12 12L22 7L12 2Z" opacity="0.8" />
            <path d="M2 17L12 22L22 17" opacity="0.6" />
            <path d="M2 12L12 17L22 12" opacity="0.4" />
            <circle cx="12" cy="12" r="2" />
        </svg>
    );
}
