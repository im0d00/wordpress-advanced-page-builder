import React from 'react';

const ELEMENTS = ['Heading', 'Paragraph', 'Image', 'Button', 'Container', 'Section', 'Row', 'Column'];

export const LeftPanel = () => (
  <aside className="nb-left-panel">
    <h3>Elements</h3>
    <ul>
      {ELEMENTS.map((el) => (
        <li key={el}>{el}</li>
      ))}
    </ul>
    <h3>Layers</h3>
    <div>Layer tree placeholder</div>
  </aside>
);
