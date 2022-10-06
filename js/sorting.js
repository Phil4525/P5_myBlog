// // script by Pierre Giraud
// // https://www.pierre-giraud.com/trier-tableau-javascript/

// const compare = (ids, asc) => (row1, row2) => {
//     const tdValue = (row, ids) => row.children[ids].textContent;
//     const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
//     return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
// };

// const tbody = document.querySelector('tbody');
// const thx = document.querySelectorAll('th');
// const trxb = tbody.querySelectorAll('tr');
// thx.forEach(th => th.addEventListener('click', () => {
//     let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
//     classe.forEach(tr => tbody.appendChild(tr));
// }));
const compare = (t, r) => (e, o) => { const a = (t, r) => t.children[r].textContent; return c = a(r ? e : o, t), n = a(r ? o : e, t), "" === c || "" === n || isNaN(c) || isNaN(n) ? c.toString().localeCompare(n) : c - n; var c, n }, tbody = document.querySelector("tbody"), thx = document.querySelectorAll("th"), trxb = tbody.querySelectorAll("tr"); thx.forEach((t => t.addEventListener("click", (() => { var r, e; Array.from(trxb).sort((r = Array.from(thx).indexOf(t), e = this.asc = !this.asc, (t, o) => { const a = (t, r) => t.children[r].textContent; return c = a(e ? t : o, r), n = a(e ? o : t, r), "" === c || "" === n || isNaN(c) || isNaN(n) ? c.toString().localeCompare(n) : c - n; var c, n })).forEach((t => tbody.appendChild(t))) }))));